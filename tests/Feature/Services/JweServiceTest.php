<?php

declare(strict_types=1);

use App\Models\Integration;
use App\Services\JweService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Encryption\Algorithm\ContentEncryption\A256GCM;
use Jose\Component\Encryption\Algorithm\KeyEncryption\Dir;
use Jose\Component\Encryption\JWEBuilder;
use Jose\Component\Encryption\Serializer\CompactSerializer;
use Jose\Component\KeyManagement\JWKFactory;

uses(RefreshDatabase::class);

function generateTokenWithPayload(Integration $integration, array $payload): string
{
    $key = JWKFactory::createFromSecret($integration->jwe_secret, ['alg' => 'A256GCM', 'use' => 'enc']);
    $jweBuilder = new JWEBuilder(new AlgorithmManager([new Dir, new A256GCM]));

    $jwe = $jweBuilder
        ->create()
        ->withPayload(json_encode($payload))
        ->withSharedProtectedHeader([
            'alg' => 'dir',
            'enc' => 'A256GCM',
        ])
        ->addRecipient($key)
        ->build();

    return (new CompactSerializer)->serialize($jwe, 0);
}

beforeEach(function () {
    $this->jweService = new JweService;
    $this->integration = Integration::factory()->create();
});

it('generates a valid jwe token', function () {
    $customerId = 123;
    $token = $this->jweService->generateForCustomer($this->integration, $customerId);
    expect($token)->toBeString();
});

it('can validate a jwe token and return the customer id', function () {
    $customerId = 123;
    $token = $this->jweService->generateForCustomer($this->integration, $customerId);
    $retrievedCustomerId = $this->jweService->validateAndGetCustomerId($this->integration, $token);
    expect($retrievedCustomerId)->toBe($customerId);
});

it('throws an exception for an expired token', function () {
    $customerId = 123;
    $token = $this->jweService->generateForCustomer($this->integration, $customerId);

    // Travel 6 minutes into the future
    $this->travel(6)->minutes();

    $this->jweService->validateAndGetCustomerId($this->integration, $token);
})->throws(InvalidArgumentException::class, 'JWE Decoding Failure: unable to decode or verify token');

it('throws an exception for a token with an invalid signature', function () {
    $customerId = 123;
    $token = $this->jweService->generateForCustomer($this->integration, $customerId);

    // Create another integration with a different secret
    $anotherIntegration = Integration::factory()->create();

    $this->jweService->validateAndGetCustomerId($anotherIntegration, $token);
})->throws(InvalidArgumentException::class, 'JWE Decoding Failure: unable to decode or verify token');

it('throws an exception when customer_id is missing from payload', function () {
    $payload = [
        'iat' => time(),
        'nbf' => time(),
        'exp' => now()->addMinutes(5)->timestamp,
    ];

    $token = generateTokenWithPayload($this->integration, $payload);

    $this->jweService->validateAndGetCustomerId($this->integration, $token);
})->throws(InvalidArgumentException::class, 'JWE Decoding Failure: missing customer_id');
