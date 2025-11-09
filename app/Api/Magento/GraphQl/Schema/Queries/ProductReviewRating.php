<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class ProductReviewRating
{
    public protected(set) ?string $name = null;

    public protected(set) ?string $value = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['value'])) {
            $instance->value = $data['value'];
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
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->value !== null) {
            $data['value'] = $this->value;
        }

        return $data;
    }
}
