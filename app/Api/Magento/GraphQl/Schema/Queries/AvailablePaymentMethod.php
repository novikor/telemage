<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class AvailablePaymentMethod
{
    public protected(set) ?string $code = null;

    public protected(set) ?bool $is_deferred = null;

    public protected(set) ?string $title = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['code'])) {
            $instance->code = $data['code'];
        }
        if (isset($data['is_deferred']) && $data['is_deferred'] !== null) {
            $instance->is_deferred = $data['is_deferred'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
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
        if ($this->code !== null) {
            $data['code'] = $this->code;
        }
        if ($this->is_deferred !== null) {
            $data['is_deferred'] = $this->is_deferred;
        }
        if ($this->title !== null) {
            $data['title'] = $this->title;
        }

        return $data;
    }
}
