<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class SalesCommentItem
{
    public protected(set) ?string $message = null;

    public protected(set) ?string $timestamp = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['message']) && $data['message'] !== null) {
            $instance->message = $data['message'];
        }
        if (isset($data['timestamp']) && $data['timestamp'] !== null) {
            $instance->timestamp = $data['timestamp'];
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
        if ($this->message !== null) {
            $data['message'] = $this->message;
        }
        if ($this->timestamp !== null) {
            $data['timestamp'] = $this->timestamp;
        }

        return $data;
    }
}
