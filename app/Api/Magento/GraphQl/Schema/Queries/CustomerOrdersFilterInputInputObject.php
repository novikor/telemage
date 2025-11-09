<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\InputObject;

class CustomerOrdersFilterInputInputObject extends InputObject
{
    protected $grand_total;

    protected $number;

    protected $order_date;

    protected $status;

    public function setGrandTotal(FilterRangeTypeInputInputObject $filterRangeTypeInputInputObject): static
    {
        $this->grand_total = $filterRangeTypeInputInputObject;

        return $this;
    }

    public function setNumber(FilterStringTypeInputInputObject $filterStringTypeInputInputObject): static
    {
        $this->number = $filterStringTypeInputInputObject;

        return $this;
    }

    public function setOrderDate(FilterRangeTypeInputInputObject $filterRangeTypeInputInputObject): static
    {
        $this->order_date = $filterRangeTypeInputInputObject;

        return $this;
    }

    public function setStatus(FilterEqualTypeInputInputObject $filterEqualTypeInputInputObject): static
    {
        $this->status = $filterEqualTypeInputInputObject;

        return $this;
    }
}
