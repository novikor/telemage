<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class ProductReviews
{
    /** @var ProductReview[] */
    public protected(set) ?array $items = null;

    public protected(set) ?SearchResultPageInfo $page_info = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['items'])) {
            $instance->items = array_map(ProductReview::fromArray(...), $data['items']);
        }
        if (isset($data['page_info'])) {
            $instance->page_info = SearchResultPageInfo::fromArray($data['page_info']);
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
        if ($this->items !== null) {
            $data['items'] = array_map(fn (ProductReview $item) => $item->asArray(), $this->items);
        }
        if ($this->page_info instanceof SearchResultPageInfo) {
            $data['page_info'] = $this->page_info->asArray();
        }

        return $data;
    }
}
