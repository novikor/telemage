<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\ArgumentsObject;

class CartItemsV2ArgumentsObject extends ArgumentsObject
{
    protected $pageSize;

    protected $currentPage;

    protected $sort;

    public function setPageSize($pageSize): static
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    public function setCurrentPage($currentPage): static
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    public function setSort(QuoteItemsSortInputInputObject $quoteItemsSortInputInputObject): static
    {
        $this->sort = $quoteItemsSortInputInputObject;

        return $this;
    }
}
