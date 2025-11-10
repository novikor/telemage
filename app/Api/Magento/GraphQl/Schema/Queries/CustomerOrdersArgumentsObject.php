<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\RawObject;
use GraphQL\SchemaObject\ArgumentsObject;

class CustomerOrdersArgumentsObject extends ArgumentsObject
{
    protected ?CustomerOrdersFilterInputInputObject $filter = null;

    protected $currentPage;

    protected $pageSize;

    protected $sort;

    protected $scope;

    public function setFilter(CustomerOrdersFilterInputInputObject $customerOrdersFilterInputInputObject): static
    {
        $this->filter = $customerOrdersFilterInputInputObject;

        return $this;
    }

    public function setCurrentPage($currentPage): static
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    public function setPageSize($pageSize): static
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    public function setSort(CustomerOrderSortInputInputObject $customerOrderSortInputInputObject): static
    {
        $this->sort = $customerOrderSortInputInputObject;

        return $this;
    }

    public function setScope($scopeTypeEnum): static
    {
        $this->scope = new RawObject($scopeTypeEnum);

        return $this;
    }
}
