<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\InputObject;

class FilterRangeTypeInputInputObject extends InputObject
{
    protected $from;

    protected $to;

    public function setFrom($from): static
    {
        $this->from = $from;

        return $this;
    }

    public function setTo($to): static
    {
        $this->to = $to;

        return $this;
    }
}
