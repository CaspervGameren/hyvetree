<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_assigns_user_role_and_ignores_admin_input(): void
    {
        $this->seed(RoleSeeder::class);
        $admin = Role::where('name', 'admin')->firstOrFail();
        $this->post('/register', ['name' => 'New member', 'email' => 'member@example.com', 'password' => 'long-test-password', 'password_confirmation' => 'long-test-password', 'role_id' => $admin->id])
            ->assertRedirect(route('home'));
        $user = User::where('email', 'member@example.com')->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $this->assertTrue(Hash::check('long-test-password', $user->password));
        $this->assertTrue($user->roles()->where('name', 'user')->exists());
        $this->assertFalse($user->isAdmin());
    }

    public function test_registration_validates_duplicates_and_password_confirmation(): void
    {
        $user = User::factory()->create();
        $this->post('/register', ['name' => 'Test', 'email' => $user->email, 'password' => 'short', 'password_confirmation' => 'different'])
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function test_profile_updates_only_authenticated_user_and_resets_email_verification(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $this->actingAs($user)->get('/profile')->assertOk()->assertSee($user->email);
        $this->get('/profile/edit')->assertOk()->assertSee('Edit profile');
        $this->patch('/profile', ['name' => 'Changed member', 'email' => 'changed@example.com', 'id' => $other->id, 'roles' => ['admin']])
            ->assertRedirect(route('profile.show'));
        $this->assertSame('Changed member', $user->fresh()->name);
        $this->assertNull($user->fresh()->email_verified_at);
        $this->assertNotSame('Changed member', $other->fresh()->name);
        $this->assertFalse($user->fresh()->isAdmin());
        $this->patch('/profile', ['name' => 'Changed member', 'email' => $other->email])->assertSessionHasErrors('email');
    }

    public function test_logout_clears_authentication(): void
    {
        $this->actingAs(User::factory()->create())->post('/logout')->assertRedirect('/');
        $this->assertGuest();
        $this->get('/profile')->assertRedirect(route('login'));
    }

    public function test_login_attempts_are_throttled(): void
    {
        for ($attempt = 0; $attempt < 6; $attempt++) {
            $this->post('/login', ['email' => 'missing@example.com', 'password' => 'incorrect'])->assertRedirect();
        }
        $this->post('/login', ['email' => 'missing@example.com', 'password' => 'incorrect'])->assertStatus(429);
    }
}
