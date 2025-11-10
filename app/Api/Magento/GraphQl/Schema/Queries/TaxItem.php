<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class TaxItem
{
    public protected(set) ?Money $amount = null;

    public protected(set) ?float $rate = null;

    public protected(set) ?string $title = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['amount'])) {
            $instance->amount = Money::fromArray($data['amount']);
        }
        if (isset($data['rate'])) {
            $instance->rate = $data['rate'];
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
        if ($this->amount instanceof Money) {
            $data['amount'] = $this->amount->asArray();
        }
        if ($this->rate !== null) {
            $data['rate'] = $this->rate;
        }
        if ($this->title !== null) {
            $data['title'] = $this->title;
        }

        return $data;
    }
}
