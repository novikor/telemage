<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\InputObject;

class CustomerOrderSortInputInputObject extends InputObject
{
    protected $sort_direction;

    protected $sort_field;

    public function setSortDirection($sortDirection): static
    {
        $this->sort_direction = $sortDirection;

        return $this;
    }

    public function setSortField($sortField): static
    {
        $this->sort_field = $sortField;

        return $this;
    }
}
