<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class OrderPaymentMethod
{
    /** @var KeyValue[] */
    public protected(set) ?array $additional_data = null;

    public protected(set) ?string $name = null;

    public protected(set) ?string $type = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['additional_data'])) {
            $instance->additional_data = array_map(KeyValue::fromArray(...), $data['additional_data']);
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
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
        if ($this->additional_data !== null) {
            $data['additional_data'] = array_map(fn (KeyValue $item) => $item->asArray(), $this->additional_data);
        }
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->type !== null) {
            $data['type'] = $this->type;
        }

        return $data;
    }
}
