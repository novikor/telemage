<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class ShipmentTracking
{
    public protected(set) ?string $carrier = null;

    public protected(set) ?string $number = null;

    public protected(set) ?string $title = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['carrier'])) {
            $instance->carrier = $data['carrier'];
        }
        if (isset($data['number'])) {
            $instance->number = $data['number'];
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
        if ($this->carrier !== null) {
            $data['carrier'] = $this->carrier;
        }
        if ($this->number !== null) {
            $data['number'] = $this->number;
        }
        if ($this->title !== null) {
            $data['title'] = $this->title;
        }

        return $data;
    }
}
