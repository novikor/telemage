<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CartDiscount
{
    public protected(set) ?Money $amount = null;

    public protected(set) ?array $label = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['amount'])) {
            $instance->amount = Money::fromArray($data['amount']);
        }
        if (isset($data['label'])) {
            $instance->label = $data['label'];
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
        if ($this->amount instanceof Money) {
            $data['amount'] = $this->amount->asArray();
        }
        if ($this->label !== null) {
            $data['label'] = $this->label;
        }

        return $data;
    }
}
