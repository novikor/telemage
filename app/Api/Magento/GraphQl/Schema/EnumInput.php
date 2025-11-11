<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema;

use GraphQL\SchemaObject\InputObject;

class EnumInput extends InputObject
{
    #[\Override]
    public function __toString(): string
    {
        $objectString = '{';
        $first = true;

        foreach (get_object_vars($this) as $name => $value) {
            if (empty($value)) {
                continue;
            }

            // Append space at the beginning if it's not the first item on the list
            if ($first) {
                $first = false;
            } else {
                $objectString .= ', ';
            }
            if (! $value instanceof \BackedEnum) {
                throw new \InvalidArgumentException('EnumInput can only be used with backed enums');
            }
            $objectString .= $name.': '.$value->value;
        }

        return $objectString.'}';
    }
}
