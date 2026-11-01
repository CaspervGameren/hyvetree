<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectWorkflowTest extends TestCase
{
    use RefreshDatabase;

    private function project(User $owner, array $data = []): Project
    {
        return $owner->projects()->create(array_merge([
            'title' => 'A project', 'summary' => 'A useful summary', 'status' => 'planned', 'is_public' => false,
        ], $data));
    }

    private function payload(array $data = []): array
    {
        return array_merge(['title' => 'New project', 'summary' => 'A useful summary', 'status' => 'planned', 'is_public' => '0'], $data);
    }

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->roles()->attach(Role::firstOrCreate(['name' => 'admin']));

        return $user;
    }

    public function test_create_assigns_authenticated_owner_ignoring_forged_owner_and_slug(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $response = $this->actingAs($owner)->post('/projects', $this->payload(['user_id' => $other->id, 'slug' => 'forged']));
        $project = Project::firstOrFail();
        $response->assertRedirect(route('projects.show', $project));
        $this->assertSame($owner->id, $project->user_id);
        $this->assertNotSame('forged', $project->slug);
        $this->get(route('projects.show', $project))->assertOk()->assertSee('New project');
    }

    public function test_duplicate_titles_have_unique_slugs_which_stay_stable_on_edit(): void
    {
        $user = User::factory()->create();
        $a = $this->project($user);
        $b = $this->project($user);
        $this->assertNotSame($a->slug, $b->slug);
        $slug = $a->slug;
        $this->actingAs($user)->patch(route('projects.update', $a), $this->payload(['title' => 'Changed']))->assertSessionHasNoErrors();
        $this->assertSame($slug, $a->fresh()->slug);
    }

    public function test_owner_can_edit_update_and_delete(): void
    {
        $user = User::factory()->create();
        $project = $this->project($user);
        $this->actingAs($user)->get(route('projects.edit', $project))->assertOk()->assertSee('Edit Project');
        $this->patch(route('projects.update', $project), $this->payload(['title' => 'Updated title']))->assertRedirect(route('projects.show', $project));
        $this->assertSame('Updated title', $project->fresh()->title);
        $this->delete(route('projects.destroy', $project))->assertRedirect(route('projects.manage'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_other_user_cannot_view_private_project_or_modify_any_project(): void
    {
        $owner = User::factory()->create();
        $project = $this->project($owner);
        $this->actingAs(User::factory()->create());
        $this->get(route('projects.show', $project))->assertForbidden();
        $this->get(route('projects.edit', $project))->assertForbidden();
        $this->patch(route('projects.update', $project), $this->payload())->assertForbidden();
        $this->delete(route('projects.destroy', $project))->assertForbidden();
        $this->post(route('projects.visibility', $project))->assertForbidden();
        $this->post(route('projects.like', $project))->assertForbidden();
    }

    public function test_public_discovery_and_search_only_include_public_or_owned_projects(): void
    {
        $owner = User::factory()->create();
        $viewer = User::factory()->create();
        $this->project($owner, ['title' => 'Public needle', 'is_public' => true]);
        $this->project($owner, ['title' => 'Secret needle']);
        $this->project($viewer, ['title' => 'My needle']);
        $this->actingAs($viewer)->get('/projects?q=needle')->assertOk()
            ->assertSee('Public needle')->assertSee('My needle')->assertDontSee('Secret needle');
    }

    public function test_search_matches_summary_and_combines_with_status_filter(): void
    {
        $owner = User::factory()->create();
        $this->project($owner, ['title' => 'Correct result', 'summary' => 'Laravel lessons', 'status' => 'completed']);
        $this->project($owner, ['title' => 'Excluded result', 'summary' => 'Laravel lessons', 'status' => 'planned']);
        $this->actingAs($owner)->get('/projects?q=Laravel&status=completed')->assertOk()->assertSee('Correct result')->assertDontSee('Excluded result');
        $this->get('/projects?status=invalid')->assertSessionHasErrors('status');
    }

    public function test_server_validation_checks_required_values_dates_icons_and_status(): void
    {
        $this->actingAs(User::factory()->create());
        $this->post('/projects', [])->assertSessionHasErrors(['title', 'summary', 'status', 'is_public']);
        $this->post('/projects', $this->payload(['started_at' => '2026-11-10', 'target_end_date' => '2026-11-01', 'status' => 'invalid', 'icon' => '<script>']))
            ->assertSessionHasErrors(['target_end_date', 'status', 'icon']);
        $this->post('/projects', $this->payload(['started_at' => '2026-11-10', 'target_end_date' => null]))->assertSessionHasNoErrors();
    }

    public function test_publishing_requires_three_existing_projects_and_cannot_be_bypassed_in_forms(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post('/projects', $this->payload(['is_public' => '1']))->assertSessionHasErrors('is_public');
        $project = $this->project($user);
        $this->patch(route('projects.update', $project), $this->payload(['is_public' => '1']))->assertSessionHasErrors('is_public');
        $this->post(route('projects.visibility', $project))->assertSessionHasErrors('is_public');
        $this->assertFalse($project->fresh()->is_public);
        $this->project($user);
        $this->project($user);
        $this->post(route('projects.visibility', $project))->assertSessionHasNoErrors();
        $this->assertTrue($project->fresh()->is_public);
        $this->post(route('projects.visibility', $project))->assertSessionHasNoErrors();
        $this->assertFalse($project->fresh()->is_public);
    }

    public function test_likes_toggle_and_appear_in_separate_manage_section(): void
    {
        $project = $this->project(User::factory()->create(), ['title' => 'Liked example', 'is_public' => true]);
        $user = User::factory()->create();
        $this->actingAs($user)->post(route('projects.like', $project))->assertRedirect();
        $this->assertSame(1, $user->likedProjects()->count());
        $this->get('/projects/manage')->assertOk()->assertSee('My projects')->assertSee('Liked projects')->assertSee('Liked example');
        $project->update(['is_public' => false]);
        $this->get('/projects/manage')->assertDontSee('Liked example');
        $project->update(['is_public' => true]);
        $this->post(route('projects.like', $project))->assertRedirect();
        $this->assertSame(0, $user->likedProjects()->count());
    }

    public function test_admin_can_manage_all_visibility_but_cannot_edit_another_owners_content(): void
    {
        $owner = User::factory()->create();
        $project = $this->project($owner, ['title' => 'Private administration']);
        $this->project($owner);
        $this->project($owner);
        $this->actingAs($this->admin())->get('/admin/projects')->assertOk()->assertSee('Private administration');
        $this->get(route('projects.show', $project))->assertOk();
        $this->get(route('projects.edit', $project))->assertForbidden();
        $this->patch(route('projects.update', $project), $this->payload())->assertForbidden();
        $this->post(route('projects.visibility', $project))->assertSessionHasNoErrors();
        $this->assertTrue($project->fresh()->is_public);
        $this->delete(route('projects.destroy', $project))->assertRedirect();
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_admin_pages_reject_regular_users_and_guests(): void
    {
        $this->get('/admin/projects')->assertRedirect(route('login'));
        $this->actingAs(User::factory()->create())->get('/admin/projects')->assertForbidden();
    }

    public function test_visibility_endpoint_rejects_get(): void
    {
        $user = User::factory()->create();
        $project = $this->project($user);
        $this->actingAs($user)->get(route('projects.visibility', $project))->assertStatus(405);
    }

    public function test_public_access_does_not_allow_changing_another_users_project(): void
    {
        $project = $this->project(User::factory()->create(), ['is_public' => true]);
        $this->actingAs(User::factory()->create());
        $this->get(route('projects.show', $project))->assertOk();
        $this->patch(route('projects.update', $project), $this->payload())->assertForbidden();
        $this->delete(route('projects.destroy', $project))->assertForbidden();
        $this->post(route('projects.visibility', $project))->assertForbidden();
    }

    public function test_user_content_is_escaped_and_search_input_cannot_expose_private_projects(): void
    {
        $owner = User::factory()->create();
        $project = $this->project($owner, ['title' => '<script>alert(1)</script>', 'is_public' => true]);
        $this->project($owner, ['title' => 'Hidden private item']);
        $this->actingAs(User::factory()->create())->get(route('projects.show', $project))
            ->assertOk()->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
        $this->get('/projects?'.http_build_query(['q' => "' OR 1=1 --"]))
            ->assertOk()->assertDontSee('Hidden private item');
    }
}
