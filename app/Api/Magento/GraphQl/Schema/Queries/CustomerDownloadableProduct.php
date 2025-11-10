<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CustomerDownloadableProduct
{
    public protected(set) ?string $date = null;

    public protected(set) ?string $download_url = null;

    public protected(set) ?string $order_increment_id = null;

    public protected(set) ?string $remaining_downloads = null;

    public protected(set) ?string $status = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['download_url'])) {
            $instance->download_url = $data['download_url'];
        }
        if (isset($data['order_increment_id'])) {
            $instance->order_increment_id = $data['order_increment_id'];
        }
        if (isset($data['remaining_downloads'])) {
            $instance->remaining_downloads = $data['remaining_downloads'];
        }
        if (isset($data['status'])) {
            $instance->status = $data['status'];
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
        if ($this->date !== null) {
            $data['date'] = $this->date;
        }
        if ($this->download_url !== null) {
            $data['download_url'] = $this->download_url;
        }
        if ($this->order_increment_id !== null) {
            $data['order_increment_id'] = $this->order_increment_id;
        }
        if ($this->remaining_downloads !== null) {
            $data['remaining_downloads'] = $this->remaining_downloads;
        }
        if ($this->status !== null) {
            $data['status'] = $this->status;
        }

        return $data;
    }
}
