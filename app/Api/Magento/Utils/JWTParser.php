<?php

declare(strict_types=1);

namespace App\Api\Magento\Utils;

use Illuminate\Support\Carbon;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\Serializer\JWSSerializerManager;

class JWTParser
{
    public function getExpiration(string $jwt): ?Carbon
    {
        $serializerManager = new JWSSerializerManager([
            new CompactSerializer,
        ]);
        $token = $serializerManager->unserialize($jwt);

        $payload = json_decode((string) $token->getPayload(), true);
        if (! isset($payload['exp'])) {
            return null;
        }

        return new Carbon($payload['exp']);
    }
}
