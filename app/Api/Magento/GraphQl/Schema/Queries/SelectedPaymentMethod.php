<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class SelectedPaymentMethod
{
    public protected(set) ?string $code = null;

    public protected(set) ?string $purchase_order_number = null;

    public protected(set) ?string $title = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['code'])) {
            $instance->code = $data['code'];
        }
        if (isset($data['purchase_order_number']) && $data['purchase_order_number'] !== null) {
            $instance->purchase_order_number = $data['purchase_order_number'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
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
        if ($this->code !== null) {
            $data['code'] = $this->code;
        }
        if ($this->purchase_order_number !== null) {
            $data['purchase_order_number'] = $this->purchase_order_number;
        }
        if ($this->title !== null) {
            $data['title'] = $this->title;
        }

        return $data;
    }
}
