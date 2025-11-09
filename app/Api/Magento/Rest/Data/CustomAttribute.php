<?php

declare(strict_types=1);

namespace App\Api\Magento\Rest\Data;

readonly class CustomAttribute
{
    public function __construct(
        public string $attribute_code,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            attribute_code: data_get($data, 'attribute_code'),
            value: data_get($data, 'value'),
        );
    }
}
