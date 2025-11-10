<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class PaymentSourceDetails
{
    public protected(set) ?Card $card = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['card'])) {
            $instance->card = Card::fromArray($data['card']);
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
        if ($this->card instanceof Card) {
            $data['card'] = $this->card->asArray();
        }

        return $data;
    }
}
