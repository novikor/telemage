<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\InputObject;

class FilterEqualTypeInputInputObject extends InputObject
{
    protected $eq;

    protected $in;

    public function setEq($eq): static
    {
        $this->eq = $eq;

        return $this;
    }

    public function setIn(array $in): static
    {
        $this->in = $in;

        return $this;
    }
}
