<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CartAddressRegion
{
    public protected(set) ?string $code = null;

    public protected(set) ?string $label = null;

    public protected(set) ?int $region_id = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['code'])) {
            $instance->code = $data['code'];
        }
        if (isset($data['label'])) {
            $instance->label = $data['label'];
        }
        if (isset($data['region_id'])) {
            $instance->region_id = $data['region_id'];
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
        if ($this->label !== null) {
            $data['label'] = $this->label;
        }
        if ($this->region_id !== null) {
            $data['region_id'] = $this->region_id;
        }

        return $data;
    }
}
