<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CardBinQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CardBin';

    public function selectBin(): static
    {
        $this->selectField('bin');

        return $this;
    }
}
