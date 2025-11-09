<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\InputObject;

class OrderTokenInputInputObject extends InputObject
{
    protected $token;

    public function setToken($token): static
    {
        $this->token = $token;

        return $this;
    }
}
