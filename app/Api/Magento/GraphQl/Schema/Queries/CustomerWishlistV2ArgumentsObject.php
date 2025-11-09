<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\ArgumentsObject;

class CustomerWishlistV2ArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }
}
