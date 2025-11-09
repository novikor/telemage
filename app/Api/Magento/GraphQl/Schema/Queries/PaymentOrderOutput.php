<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class PaymentOrderOutput
{
    public protected(set) ?string $id = null;

    public protected(set) ?string $mp_order_id = null;

    public protected(set) ?PaymentSourceDetails $payment_source_details = null;

    public protected(set) ?string $status = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['mp_order_id']) && $data['mp_order_id'] !== null) {
            $instance->mp_order_id = $data['mp_order_id'];
        }
        if (isset($data['payment_source_details']) && $data['payment_source_details'] !== null) {
            $instance->payment_source_details = PaymentSourceDetails::fromArray($data['payment_source_details']);
        }
        if (isset($data['status']) && $data['status'] !== null) {
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
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->mp_order_id !== null) {
            $data['mp_order_id'] = $this->mp_order_id;
        }
        if ($this->payment_source_details instanceof PaymentSourceDetails) {
            $data['payment_source_details'] = $this->payment_source_details->asArray();
        }
        if ($this->status !== null) {
            $data['status'] = $this->status;
        }

        return $data;
    }
}
