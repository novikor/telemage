<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class SearchResultPageInfoQueryObject extends QueryObject
{
    const OBJECT_NAME = 'SearchResultPageInfo';

    public function selectCurrentPage(): static
    {
        $this->selectField('current_page');

        return $this;
    }

    public function selectPageSize(): static
    {
        $this->selectField('page_size');

        return $this;
    }

    public function selectTotalPages(): static
    {
        $this->selectField('total_pages');

        return $this;
    }
}
