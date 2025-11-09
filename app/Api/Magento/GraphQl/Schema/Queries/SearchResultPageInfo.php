<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class SearchResultPageInfo
{
    public protected(set) ?int $current_page = null;

    public protected(set) ?int $page_size = null;

    public protected(set) ?int $total_pages = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['current_page']) && $data['current_page'] !== null) {
            $instance->current_page = $data['current_page'];
        }
        if (isset($data['page_size']) && $data['page_size'] !== null) {
            $instance->page_size = $data['page_size'];
        }
        if (isset($data['total_pages']) && $data['total_pages'] !== null) {
            $instance->total_pages = $data['total_pages'];
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
        if ($this->current_page !== null) {
            $data['current_page'] = $this->current_page;
        }
        if ($this->page_size !== null) {
            $data['page_size'] = $this->page_size;
        }
        if ($this->total_pages !== null) {
            $data['total_pages'] = $this->total_pages;
        }

        return $data;
    }
}
