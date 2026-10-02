<?php

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

test('login page renders for guests', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee('name="password"', false);
});

test('login page is served at /login', function () {
    expect(route('login', absolute: false))->toBe('/login');
});

test('admin panel lives under /modify and the old /admin paths no longer exist', function () {
    expect(route('admin.dashboard', absolute: false))->toBe('/modify')
        ->and(route('admin.partners.index', absolute: false))->toBe('/modify/partners');

    $this->get('/modify')->assertRedirect(route('login'));
    $this->get('/admin')->assertNotFound();
    $this->get('/admin/login')->assertNotFound();
});

test('guests are redirected from the admin panel to the login page', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    $this->get(route('admin.messages.index'))->assertRedirect(route('login'));
});

test('administrator can sign in with valid credentials', function () {
    $user = User::factory()->create();

    $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($user);
});

test('administrator cannot sign in with an invalid password', function () {
    $user = User::factory()->create();

    $this->from(route('login'))
        ->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ])
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors(['email' => 'И-мэйл эсвэл нууц үг буруу байна.']);

    $this->assertGuest();
});

test('login is locked after too many failed attempts', function () {
    $user = User::factory()->create();

    foreach (range(1, 5) as $attempt) {
        $this->post(route('login.store'), ['email' => $user->email, 'password' => 'wrong-password']);
    }

    $this->post(route('login.store'), ['email' => $user->email, 'password' => 'password'])
        ->assertSessionHasErrors('email');

    $this->assertGuest();

    RateLimiter::clear(strtolower($user->email).'|127.0.0.1');
});

test('signed in administrator is redirected away from the login page', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('login'))
        ->assertRedirect(route('admin.dashboard'));
});

test('administrator can sign out', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('admin.logout'))
        ->assertRedirect(route('login'));

    $this->assertGuest();
});

test('create admin command creates a user that can sign in', function () {
    $this->artisan('app:create-admin', [
        '--name' => 'Admin',
        '--email' => 'admin@example.com',
        '--password' => 'secret-password',
    ])->assertSuccessful();

    $this->post(route('login.store'), [
        'email' => 'admin@example.com',
        'password' => 'secret-password',
    ])->assertRedirect(route('admin.dashboard'));
});

test('create admin command rejects a short password', function () {
    $this->artisan('app:create-admin', [
        '--name' => 'Admin',
        '--email' => 'admin@example.com',
        '--password' => 'short',
    ])->assertFailed();

    $this->assertDatabaseMissing('users', ['email' => 'admin@example.com']);
});
