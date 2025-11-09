<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class GiftMessage
{
    public protected(set) ?string $from = null;

    public protected(set) ?string $message = null;

    public protected(set) ?string $to = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['from']) && $data['from'] !== null) {
            $instance->from = $data['from'];
        }
        if (isset($data['message']) && $data['message'] !== null) {
            $instance->message = $data['message'];
        }
        if (isset($data['to']) && $data['to'] !== null) {
            $instance->to = $data['to'];
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
        if ($this->from !== null) {
            $data['from'] = $this->from;
        }
        if ($this->message !== null) {
            $data['message'] = $this->message;
        }
        if ($this->to !== null) {
            $data['to'] = $this->to;
        }

        return $data;
    }
}
