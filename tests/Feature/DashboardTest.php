<?php

declare(strict_types=1);

use App\Models\User;

test('guests are redirected to the login page', function () {
    test()->get('/')->assertRedirect('/auth/login');
});

test('authenticated users can visit the dashboard', function () {
    test()->actingAs($user = User::factory()->create());

    test()->get('/')->assertStatus(200);
});
