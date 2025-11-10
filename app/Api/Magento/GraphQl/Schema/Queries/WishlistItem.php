<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use Carbon\Carbon;

class WishlistItem
{
    public protected(set) ?Carbon $added_at = null;

    public protected(set) ?string $description = null;

    public protected(set) ?int $id = null;

    public protected(set) ?float $qty = null;

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
        if (isset($data['added_at'])) {
            $instance->added_at = new Carbon($data['added_at']);
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['product'])) {
            $instance->product = $data['product'];
        }
        if (isset($data['qty'])) {
            $instance->qty = $data['qty'];
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
        if ($this->added_at instanceof Carbon) {
            $data['added_at'] = $this->added_at->toIso8601String();
        }
        if ($this->description !== null) {
            $data['description'] = $this->description;
        }
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->product !== null) {
            $data['product'] = $this->product;
        }
        if ($this->qty !== null) {
            $data['qty'] = $this->qty;
        }

        return $data;
    }
}
