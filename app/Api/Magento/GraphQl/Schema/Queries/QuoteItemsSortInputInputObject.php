<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\InputObject;

class QuoteItemsSortInputInputObject extends InputObject
{
    protected $field;

    protected $order;

    public function setField($field): static
    {
        $this->field = $field;

        return $this;
    }

    public function setOrder($order): static
    {
        $this->order = $order;

        return $this;
    }
}
