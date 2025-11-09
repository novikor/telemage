<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CustomerOrders
{
    public protected(set) ?string $date_of_first_order = null;

    public protected(set) ?array $items = null;

    public protected(set) ?SearchResultPageInfo $page_info = null;

    public protected(set) ?int $total_count = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['date_of_first_order']) && $data['date_of_first_order'] !== null) {
            $instance->date_of_first_order = $data['date_of_first_order'];
        }
        if (isset($data['items'])) {
            $instance->items = array_map(CustomerOrder::fromArray(...), $data['items']);
        }
        if (isset($data['page_info'])) {
            $instance->page_info = SearchResultPageInfo::fromArray($data['page_info']);
        }
        if (isset($data['total_count']) && $data['total_count'] !== null) {
            $instance->total_count = $data['total_count'];
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
        if ($this->date_of_first_order !== null) {
            $data['date_of_first_order'] = $this->date_of_first_order;
        }
        if ($this->items !== null) {
            $data['items'] = array_map(fn ($item) => $item->asArray(), $this->items);
        }
        if ($this->page_info instanceof SearchResultPageInfo) {
            $data['page_info'] = $this->page_info->asArray();
        }
        if ($this->total_count !== null) {
            $data['total_count'] = $this->total_count;
        }

        return $data;
    }
}
