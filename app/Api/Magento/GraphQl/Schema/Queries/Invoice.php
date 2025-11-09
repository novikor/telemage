<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class Invoice
{
    public protected(set) ?array $comments = null;

    public protected(set) ?string $id = null;

    public protected(set) ?array $items = null;

    public protected(set) ?string $number = null;

    public protected(set) ?InvoiceTotal $total = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['comments'])) {
            $instance->comments = array_map(SalesCommentItem::fromArray(...), $data['comments']);
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['items'])) {
            $instance->items = $data['items'];
        }
        if (isset($data['number'])) {
            $instance->number = $data['number'];
        }
        if (isset($data['total']) && $data['total'] !== null) {
            $instance->total = InvoiceTotal::fromArray($data['total']);
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
        if ($this->comments !== null) {
            $data['comments'] = array_map(fn ($item) => $item->asArray(), $this->comments);
        }
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->items !== null) {
            $data['items'] = $this->items;
        }
        if ($this->number !== null) {
            $data['number'] = $this->number;
        }
        if ($this->total instanceof InvoiceTotal) {
            $data['total'] = $this->total->asArray();
        }

        return $data;
    }
}
