<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class ProductDiscount
{
    public protected(set) ?float $amount_off = null;

    public protected(set) ?float $percent_off = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['amount_off'])) {
            $instance->amount_off = $data['amount_off'];
        }
        if (isset($data['percent_off'])) {
            $instance->percent_off = $data['percent_off'];
        }

        return $instance;
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON provided to fromJson method: '.json_last_error_msg());
        }

        return self::fromArray($data);
    }

    /**
     * Converts this object to an array.
     */
    public function asArray(): array
    {
        $data = [];
        if ($this->amount_off !== null) {
            $data['amount_off'] = $this->amount_off;
        }
        if ($this->percent_off !== null) {
            $data['percent_off'] = $this->percent_off;
        }

        return $data;
    }
}
