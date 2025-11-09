<?php

declare(strict_types=1);

namespace App\Api\Magento\Data\Response;

readonly class Address
{
    /**
     * @param  array<string>  $street
     * @param  array<CustomAttribute>  $customAttributes
     */
    public function __construct(
        public ?int $id = null,
        public ?int $customerId = null,
        public ?Region $region = null,
        public ?int $regionId = null,
        public ?string $countryId = null,
        public array $street = [],
        public ?string $company = null,
        public ?string $telephone = null,
        public ?string $fax = null,
        public ?string $postcode = null,
        public ?string $city = null,
        public ?string $firstname = null,
        public ?string $lastname = null,
        public ?string $middlename = null,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public ?string $vatId = null,
        public ?bool $defaultShipping = null,
        public ?bool $defaultBilling = null,
        public array $customAttributes = [],
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        $regionData = data_get($data, 'region');

        return new self(
            id: data_get($data, 'id'),
            customerId: data_get($data, 'customer_id'),
            region: $regionData ? Region::fromArray($regionData) : null,
            regionId: data_get($data, 'region_id'),
            countryId: data_get($data, 'country_id'),
            street: data_get($data, 'street', []),
            company: data_get($data, 'company'),
            telephone: data_get($data, 'telephone'),
            fax: data_get($data, 'fax'),
            postcode: data_get($data, 'postcode'),
            city: data_get($data, 'city'),
            firstname: data_get($data, 'firstname'),
            lastname: data_get($data, 'lastname'),
            middlename: data_get($data, 'middlename'),
            prefix: data_get($data, 'prefix'),
            suffix: data_get($data, 'suffix'),
            vatId: data_get($data, 'vat_id'),
            defaultShipping: data_get($data, 'default_shipping'),
            defaultBilling: data_get($data, 'default_billing'),
            customAttributes: array_map(
                CustomAttribute::fromArray(...),
                data_get($data, 'custom_attributes', [])
            ),
        );
    }
}
