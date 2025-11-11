<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema;

use GraphQL\Mutation;

class NestedMutation extends Mutation
{
    public function __construct(string $fieldName = '', string $alias = '')
    {
        parent::__construct($fieldName, $alias);
        $this->setAsNested();
    }
}
