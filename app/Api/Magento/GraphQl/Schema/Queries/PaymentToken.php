<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class PaymentToken
{
    public protected(set) ?string $details = null;

    public protected(set) ?string $payment_method_code = null;

    public protected(set) ?string $public_hash = null;

    public protected(set) ?PaymentTokenTypeEnumEnumObject $type = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['details']) && $data['details'] !== null) {
            $instance->details = $data['details'];
        }
        if (isset($data['payment_method_code']) && $data['payment_method_code'] !== null) {
            $instance->payment_method_code = $data['payment_method_code'];
        }
        if (isset($data['public_hash']) && $data['public_hash'] !== null) {
            $instance->public_hash = $data['public_hash'];
        }
        if (isset($data['type']) && $data['type'] !== null) {
            $instance->type = $data['type'];
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
        if ($this->details !== null) {
            $data['details'] = $this->details;
        }
        if ($this->payment_method_code !== null) {
            $data['payment_method_code'] = $this->payment_method_code;
        }
        if ($this->public_hash !== null) {
            $data['public_hash'] = $this->public_hash;
        }
        if ($this->type instanceof PaymentTokenTypeEnumEnumObject) {
            $data['type'] = $this->type;
        }

        return $data;
    }
}
