<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use Carbon\Carbon;

class Wishlist
{
    public protected(set) ?string $id = null;

    public protected(set) ?array $items = null;

    public protected(set) ?int $items_count = null;

    public protected(set) ?WishlistItems $items_v2 = null;

    public protected(set) ?string $sharing_code = null;

    public protected(set) ?Carbon $updated_at = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['items'])) {
            $instance->items = array_map(WishlistItem::fromArray(...), $data['items']);
        }
        if (isset($data['items_count']) && $data['items_count'] !== null) {
            $instance->items_count = $data['items_count'];
        }
        if (isset($data['items_v2']) && $data['items_v2'] !== null) {
            $instance->items_v2 = WishlistItems::fromArray($data['items_v2']);
        }
        if (isset($data['sharing_code']) && $data['sharing_code'] !== null) {
            $instance->sharing_code = $data['sharing_code'];
        }
        if (isset($data['updated_at']) && $data['updated_at'] !== null) {
            $instance->updated_at = new Carbon($data['updated_at']);
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
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->items !== null) {
            $data['items'] = array_map(fn ($item) => $item->asArray(), $this->items);
        }
        if ($this->items_count !== null) {
            $data['items_count'] = $this->items_count;
        }
        if ($this->items_v2 instanceof WishlistItems) {
            $data['items_v2'] = $this->items_v2->asArray();
        }
        if ($this->sharing_code !== null) {
            $data['sharing_code'] = $this->sharing_code;
        }
        if ($this->updated_at instanceof Carbon) {
            $data['updated_at'] = $this->updated_at->toIso8601String();
        }

        return $data;
    }
}
