<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use App\Api\Magento\GraphQl\Schema\EnumInput;

class CustomerOrderSortInputInputObject extends EnumInput
{
    protected ?SortDirectionEnum $sort_direction = null;

    protected ?CustomerOrderSortableFieldEnum $sort_field = null;

    public function setSortDirection(SortDirectionEnum $sortDirection): static
    {
        $this->sort_direction = $sortDirection;

        return $this;
    }

    public function setSortField(CustomerOrderSortableFieldEnum $sortField): static
    {
        $this->sort_field = $sortField;

        return $this;
    }
}
