<?php

declare(strict_types=1);

namespace App\Api\Magento\Rest\Data;

readonly class Region
{
    public function __construct(
        public string $region_code,
        public string $region,
        public int $region_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            region_code: data_get($data, 'region_code'),
            region: data_get($data, 'region'),
            region_id: data_get($data, 'region_id'),
        );
    }
}
