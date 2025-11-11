<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ProductInterfaceQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ProductInterface';

    public function selectUid(): self
    {
        $this->selectField('uid');

        return $this;
    }

    public function selectId(): self
    {
        $this->selectField('id');

        return $this;
    }

    public function selectSku(): self
    {
        $this->selectField('sku');

        return $this;
    }

    public function selectName(): self
    {
        $this->selectField('name');

        return $this;
    }

    public function selectUrlKey(): self
    {
        $this->selectField('url_key');

        return $this;
    }

    public function selectTypeId(): self
    {
        $this->selectField('type_id');

        return $this;
    }

    public function selectCreatedAt(): self
    {
        $this->selectField('created_at');

        return $this;
    }

    public function selectUpdatedAt(): self
    {
        $this->selectField('updated_at');

        return $this;
    }
}
