<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class ProductInterface
{
    public protected(set) ?string $id = null;

    public protected(set) ?string $sku = null;

    public protected(set) ?string $name = null;

    public protected(set) ?string $url_key = null;

    public protected(set) ?string $type_id = null;

    public protected(set) ?string $created_at = null;

    public protected(set) ?string $updated_at = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['sku'])) {
            $instance->sku = $data['sku'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['url_key'])) {
            $instance->url_key = $data['url_key'];
        }
        if (isset($data['type_id'])) {
            $instance->type_id = $data['type_id'];
        }
        if (isset($data['created_at'])) {
            $instance->created_at = $data['created_at'];
        }
        if (isset($data['updated_at'])) {
            $instance->updated_at = $data['updated_at'];
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
        if ($this->sku !== null) {
            $data['sku'] = $this->sku;
        }
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->url_key !== null) {
            $data['url_key'] = $this->url_key;
        }
        if ($this->type_id !== null) {
            $data['type_id'] = $this->type_id;
        }
        if ($this->created_at !== null) {
            $data['created_at'] = $this->created_at;
        }
        if ($this->updated_at !== null) {
            $data['updated_at'] = $this->updated_at;
        }

        return $data;
    }
}
