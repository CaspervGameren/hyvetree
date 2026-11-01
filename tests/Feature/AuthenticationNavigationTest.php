<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_open_login_from_home(): void
    {
        $this->get('/')->assertOk()->assertSee(route('login'), false)->assertSee('Log in');
        $this->get('/login')->assertOk()->assertSee('Welcome back.')->assertSee(route('login.store'), false);
        $this->get('/projects')->assertRedirect(route('login'));
    }

    public function test_authenticated_users_see_dashboard_and_are_redirected_from_guest_pages(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/')->assertOk()->assertSee('Dashboard')->assertDontSee('Create account');
        $this->get('/login')->assertRedirect('/');
        $this->get('/register')->assertRedirect('/');
    }

    public function test_login_authenticates_and_returns_to_intended_project_page(): void
    {
        $user = User::factory()->create(['password' => 'correct-test-password']);
        $this->get('/projects')->assertRedirect(route('login'));
        $this->post('/login', ['email' => $user->email, 'password' => 'correct-test-password'])
            ->assertRedirect('/projects');
        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_login_returns_errors_without_authenticating(): void
    {
        $user = User::factory()->create();
        $this->from('/login')->post('/login', ['email' => $user->email, 'password' => 'wrong-password'])
            ->assertRedirect('/login')->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
