<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CustomerAddressRegion
{
    public protected(set) ?string $region = null;

    public protected(set) ?string $region_code = null;

    public protected(set) ?int $region_id = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['region'])) {
            $instance->region = $data['region'];
        }
        if (isset($data['region_code'])) {
            $instance->region_code = $data['region_code'];
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
        if ($this->region !== null) {
            $data['region'] = $this->region;
        }
        if ($this->region_code !== null) {
            $data['region_code'] = $this->region_code;
        }
        if ($this->region_id !== null) {
            $data['region_id'] = $this->region_id;
        }

        return $data;
    }
}
