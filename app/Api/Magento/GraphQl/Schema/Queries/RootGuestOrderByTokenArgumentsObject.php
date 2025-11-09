<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\ArgumentsObject;

class RootGuestOrderByTokenArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(OrderTokenInputInputObject $orderTokenInputInputObject): static
    {
        $this->input = $orderTokenInputInputObject;

        return $this;
    }
}
