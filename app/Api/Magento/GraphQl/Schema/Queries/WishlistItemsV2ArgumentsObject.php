<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\ArgumentsObject;

class WishlistItemsV2ArgumentsObject extends ArgumentsObject
{
    protected $currentPage;

    protected $pageSize;

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
}
