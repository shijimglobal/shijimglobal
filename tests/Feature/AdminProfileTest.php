<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('profile page is displayed', function () {
    $administrator = User::factory()->create(['name' => 'Админ Бат']);

    $this->actingAs($administrator)
        ->get(route('admin.profile.edit'))
        ->assertOk()
        ->assertSee('Админ Бат');
});

test('guests cannot see the profile page', function () {
    $this->get(route('admin.profile.edit'))->assertRedirect(route('login'));
});

test('name and email can be updated', function () {
    $administrator = User::factory()->create();

    $this->actingAs($administrator)
        ->put(route('admin.profile.update'), [
            'name' => 'Шинэ Нэр',
            'email' => 'new@example.com',
        ])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHasNoErrors();

    $administrator->refresh();

    expect($administrator->name)->toBe('Шинэ Нэр')
        ->and($administrator->email)->toBe('new@example.com');
});

test('email must be unique', function () {
    User::factory()->create(['email' => 'taken@example.com']);
    $administrator = User::factory()->create();

    $this->actingAs($administrator)
        ->put(route('admin.profile.update'), [
            'name' => 'Нэр',
            'email' => 'taken@example.com',
        ])
        ->assertSessionHasErrors('email');
});

test('password can be changed with the current password', function () {
    $administrator = User::factory()->create();

    $this->actingAs($administrator)
        ->put(route('admin.profile.password'), [
            'current_password' => 'password',
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHasNoErrors();

    expect(Hash::check('new-password-123', $administrator->fresh()->password))->toBeTrue();
});

test('password is not changed when the current password is wrong', function () {
    $administrator = User::factory()->create();

    $this->actingAs($administrator)
        ->put(route('admin.profile.password'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ])
        ->assertSessionHasErrorsIn('updatePassword', ['current_password' => 'Нууц үг буруу байна.']);

    expect(Hash::check('password', $administrator->fresh()->password))->toBeTrue();
});

test('new password must be confirmed and contain letters and numbers', function () {
    $administrator = User::factory()->create();

    $this->actingAs($administrator)
        ->put(route('admin.profile.password'), [
            'current_password' => 'password',
            'password' => 'onlyletters',
            'password_confirmation' => 'different',
        ])
        ->assertSessionHasErrorsIn('updatePassword', 'password');
});
