<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\ArgumentsObject;

class RootGuestOrderArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(OrderInformationInputInputObject $orderInformationInputInputObject): static
    {
        $this->input = $orderInformationInputInputObject;

        return $this;
    }
}
