<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CompareList
{
    public protected(set) ?array $attributes = null;

    public protected(set) ?int $item_count = null;

    public protected(set) ?array $items = null;

    public protected(set) ?string $uid = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['attributes']) && $data['attributes'] !== null) {
            $instance->attributes = array_map(ComparableAttribute::fromArray(...), $data['attributes']);
        }
        if (isset($data['item_count']) && $data['item_count'] !== null) {
            $instance->item_count = $data['item_count'];
        }
        if (isset($data['items'])) {
            $instance->items = array_map(ComparableItem::fromArray(...), $data['items']);
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
        if ($this->item_count !== null) {
            $data['item_count'] = $this->item_count;
        }
        if ($this->items !== null) {
            $data['items'] = array_map(fn ($item) => $item->asArray(), $this->items);
        }
        if ($this->uid !== null) {
            $data['uid'] = $this->uid;
        }

        return $data;
    }
}
