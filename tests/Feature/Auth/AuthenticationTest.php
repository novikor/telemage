<?php

declare(strict_types=1);

use App\Models\User;
use Laravel\Fortify\Features;

test('login screen can be rendered', function () {
    $response = test()->get(route('login'));

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->withoutTwoFactor()->create();

    $response = test()->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'abcABC123',
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('filament.dashboard.pages.dashboard', absolute: false));

    test()->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $response = test()->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrorsIn('email');

    test()->assertGuest();
});

test('users with two factor enabled are redirected to two factor challenge', function () {
    if (! Features::canManageTwoFactorAuthentication()) {
        test()->markTestSkipped('Two-factor authentication is not enabled.');
    }
    Features::twoFactorAuthentication([
        'confirm' => true,
        'confirmPassword' => true,
    ]);

    $user = User::factory()->create([
        'two_factor_secret' => 'secret',
        'two_factor_recovery_codes' => 'codes',
        'two_factor_confirmed_at' => now(),
    ]);

    $response = test()->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'abcABC123',
    ]);

    $response->assertRedirect(route('two-factor.login'));
    test()->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = test()->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('filament.dashboard.pages.dashboard'));
    test()->assertGuest();
});
