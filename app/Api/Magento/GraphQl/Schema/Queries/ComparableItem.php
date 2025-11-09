<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class ComparableItem
{
    public protected(set) ?array $attributes = null;

    public protected(set) ?string $uid = null;

    protected $product;

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['attributes']) && $data['attributes'] !== null) {
            $instance->attributes = array_map(ProductAttribute::fromArray(...), $data['attributes']);
        }
        if (isset($data['product']) && $data['product'] !== null) {
            $instance->product = $data['product'];
        }
        if (isset($data['uid'])) {
            $instance->uid = $data['uid'];
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
        if ($this->attributes !== null) {
            $data['attributes'] = array_map(fn ($item) => $item->asArray(), $this->attributes);
        }
        if ($this->product !== null) {
            $data['product'] = $this->product;
        }
        if ($this->uid !== null) {
            $data['uid'] = $this->uid;
        }

        return $data;
    }
}
