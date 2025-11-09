<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\ArgumentsObject;

class CustomerWishlistsArgumentsObject extends ArgumentsObject
{
    protected $pageSize;

    protected $currentPage;

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
}
