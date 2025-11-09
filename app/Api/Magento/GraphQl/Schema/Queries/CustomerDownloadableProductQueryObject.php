<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerDownloadableProductQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerDownloadableProduct';

    public function selectDate(): static
    {
        $this->selectField('date');

        return $this;
    }

    public function selectDownloadUrl(): static
    {
        $this->selectField('download_url');

        return $this;
    }

    public function selectOrderIncrementId(): static
    {
        $this->selectField('order_increment_id');

        return $this;
    }

    public function selectRemainingDownloads(): static
    {
        $this->selectField('remaining_downloads');

        return $this;
    }

    public function selectStatus(): static
    {
        $this->selectField('status');

        return $this;
    }
}
