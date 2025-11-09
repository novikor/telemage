<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\InputObject;

class FilterStringTypeInputInputObject extends InputObject
{
    protected $eq;

    protected $in;

    protected $match;

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

    public function setMatch($match): static
    {
        $this->match = $match;

        return $this;
    }
}
