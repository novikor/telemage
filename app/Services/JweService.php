<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Integration;
use Carbon\FactoryImmutable as CarbonTimeFactory;
use Exception;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Jose\Component\Checker\ClaimCheckerManager;
use Jose\Component\Checker\ExpirationTimeChecker;
use Jose\Component\Checker\IssuedAtChecker;
use Jose\Component\Checker\NotBeforeChecker;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\Encryption\Algorithm\ContentEncryption\A256GCM;
use Jose\Component\Encryption\Algorithm\KeyEncryption\Dir;
use Jose\Component\Encryption\JWEBuilder;
use Jose\Component\Encryption\JWEDecrypter;
use Jose\Component\Encryption\JWELoader;
use Jose\Component\Encryption\Serializer\CompactSerializer;
use Jose\Component\Encryption\Serializer\JWESerializerManager;
use Jose\Component\KeyManagement\JWKFactory;

readonly class JweService
{
    private const int MINUTES_LIFETIME = 5;

    public function generateForCustomer(Integration $integration, int $customerId): string
    {
        $key = $this->getJWK($integration);

        $jweBuilder = new JWEBuilder($this->getAlgorithmManager());

        $payload = json_encode([
            'iat' => now()->getTimestamp(),
            'nbf' => now()->getTimestamp(),
            'exp' => now()->addMinutes(self::MINUTES_LIFETIME)->timestamp,
            'customer_id' => $customerId,
        ]);

        $jwe = $jweBuilder
            ->create()
            ->withPayload($payload)
            ->withSharedProtectedHeader([
                'alg' => 'dir',
                'enc' => 'A256GCM',
            ])
            ->addRecipient($key)
            ->build();

        return (new CompactSerializer)->serialize($jwe, 0);
    }

    public function validateAndGetCustomerId(Integration $integration, string $token): int
    {
        $jwk = $this->getJWK($integration);
        $decrypter = new JWEDecrypter($this->getAlgorithmManager());
        $serializerManager = new JWESerializerManager([
            new CompactSerializer,
        ]);

        $jweLoader = new JWELoader(
            serializerManager: $serializerManager,
            jweDecrypter: $decrypter,
            headerCheckerManager: null
        );
        try {
            $decryptedRecipient = null;
            $jwe = $jweLoader->loadAndDecryptWithKey($token, $jwk, $decryptedRecipient);
            $payload = json_decode((string) $jwe->getPayload(), true);
            $clock = new CarbonTimeFactory;
            $claimCheckerManager = new ClaimCheckerManager([
                new IssuedAtChecker($clock),
                new NotBeforeChecker($clock),
                new ExpirationTimeChecker($clock),
            ]);
            $claimCheckerManager->check($payload);
        } catch (Exception $e) {
            Log::error('JWE decoding failed', [
                'error' => $e,
                'integration_id' => $integration->id,
                'token' => $token,
            ]);
            throw new InvalidArgumentException('JWE Decoding Failure: unable to decode or verify token', $e->getCode(), $e);
        }

        if (empty($payload['customer_id'])) {
            throw new InvalidArgumentException('JWE Decoding Failure: missing customer_id');
        }

        return (int) $payload['customer_id'];
    }

    private function getJWK(Integration $integration): JWK
    {
        return JWKFactory::createFromSecret($integration->jwe_secret, ['alg' => 'A256GCM', 'use' => 'enc']);
    }

    private function getAlgorithmManager(): AlgorithmManager
    {
        return new AlgorithmManager([new Dir, new A256GCM]);
    }
}
