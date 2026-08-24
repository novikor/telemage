<?php

declare(strict_types=1);

use App\Filament\Resources\Integrations\IntegrationResource;
use App\Filament\Resources\Users\UserResource;
use App\Models\Integration;
use App\Models\User;
use App\Policies\IntegrationPolicy;
use Filament\Facades\Filament;

it('allows admins to manage merchants while denying merchants list and create access', function () {
    $admin = User::factory()->admin()->create();
    $merchant = User::factory()->create();

    test()->actingAs($admin)
        ->get(UserResource::getUrl('index'))
        ->assertOk();
    test()->get(UserResource::getUrl('create'))->assertOk();

    test()->actingAs($merchant)
        ->get(UserResource::getUrl('index'))
        ->assertForbidden();
    test()->get(UserResource::getUrl('create'))->assertForbidden();
});

it('keeps the shared filament panel accessible to admins and merchants', function () {
    $panel = Filament::getPanel('dashboard');

    expect(User::factory()->admin()->make()->canAccessPanel($panel))->toBeTrue()
        ->and(User::factory()->make()->canAccessPanel($panel))->toBeTrue();
});

it('enforces integration ownership through policy and resource access', function () {
    $admin = User::factory()->admin()->create();
    $merchant = User::factory()->create();
    $otherMerchant = User::factory()->create();
    $ownIntegration = Integration::factory()->for($merchant)->create(['bot_token' => null]);
    $otherIntegration = Integration::factory()->for($otherMerchant)->create(['bot_token' => null]);
    $policy = new IntegrationPolicy;

    expect($policy->view($merchant, $ownIntegration))->toBeTrue()
        ->and($policy->update($merchant, $ownIntegration))->toBeTrue()
        ->and($policy->delete($merchant, $ownIntegration))->toBeTrue()
        ->and($policy->view($merchant, $otherIntegration))->toBeFalse()
        ->and($policy->update($merchant, $otherIntegration))->toBeFalse()
        ->and($policy->delete($merchant, $otherIntegration))->toBeFalse()
        ->and($policy->view($admin, $otherIntegration))->toBeTrue()
        ->and($policy->update($admin, $otherIntegration))->toBeTrue()
        ->and($policy->delete($admin, $otherIntegration))->toBeTrue();

    test()->actingAs($merchant)
        ->get(IntegrationResource::getUrl('view', ['record' => $ownIntegration]))
        ->assertOk();
    test()->get(IntegrationResource::getUrl('view', ['record' => $otherIntegration]))
        ->assertNotFound();

    test()->actingAs($admin)
        ->get(IntegrationResource::getUrl('view', ['record' => $otherIntegration]))
        ->assertOk();
});

it('scopes integration resource queries for merchants but not admins', function () {
    $admin = User::factory()->admin()->create();
    $merchant = User::factory()->create();
    $otherMerchant = User::factory()->create();
    $ownIntegration = Integration::factory()->for($merchant)->create(['bot_token' => null]);
    $otherIntegration = Integration::factory()->for($otherMerchant)->create(['bot_token' => null]);

    test()->actingAs($merchant);
    expect(IntegrationResource::getEloquentQuery()->pluck('id')->all())
        ->toBe([$ownIntegration->id]);

    test()->actingAs($admin);
    expect(IntegrationResource::getEloquentQuery()->pluck('id')->all())
        ->toEqualCanonicalizing([$ownIntegration->id, $otherIntegration->id]);
});
