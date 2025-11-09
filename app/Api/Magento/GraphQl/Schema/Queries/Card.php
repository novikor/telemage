<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class Card
{
    public protected(set) ?CardBin $bin_details = null;

    public protected(set) ?string $card_expiry_month = null;

    public protected(set) ?string $card_expiry_year = null;

    public protected(set) ?string $last_digits = null;

    public protected(set) ?string $name = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['bin_details']) && $data['bin_details'] !== null) {
            $instance->bin_details = CardBin::fromArray($data['bin_details']);
        }
        if (isset($data['card_expiry_month']) && $data['card_expiry_month'] !== null) {
            $instance->card_expiry_month = $data['card_expiry_month'];
        }
        if (isset($data['card_expiry_year']) && $data['card_expiry_year'] !== null) {
            $instance->card_expiry_year = $data['card_expiry_year'];
        }
        if (isset($data['last_digits']) && $data['last_digits'] !== null) {
            $instance->last_digits = $data['last_digits'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
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
        if ($this->bin_details instanceof CardBin) {
            $data['bin_details'] = $this->bin_details->asArray();
        }
        if ($this->card_expiry_month !== null) {
            $data['card_expiry_month'] = $this->card_expiry_month;
        }
        if ($this->card_expiry_year !== null) {
            $data['card_expiry_year'] = $this->card_expiry_year;
        }
        if ($this->last_digits !== null) {
            $data['last_digits'] = $this->last_digits;
        }
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        return $data;
    }
}
