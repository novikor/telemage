<?php

declare(strict_types=1);

namespace App\Api\Magento\Rest\Data;

readonly class Customer
{
    /**
     * @param  array<Address>  $addresses
     * @param  array<CustomAttribute>  $customAttributes
     */
    public function __construct(
        public string $email,
        public string $firstname,
        public string $lastname,
        public ?int $id = null,
        public ?int $groupId = null,
        public ?string $defaultBilling = null,
        public ?string $defaultShipping = null,
        public ?string $confirmation = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $createdIn = null,
        public ?string $dob = null,
        public ?string $middlename = null,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public ?int $gender = null,
        public ?int $storeId = null,
        public ?string $taxvat = null,
        public ?int $websiteId = null,
        public array $addresses = [],
        public ?int $disableAutoGroupChange = null,
        public array $customAttributes = [],
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: data_get($data, 'email'),
            firstname: data_get($data, 'firstname'),
            lastname: data_get($data, 'lastname'),
            id: data_get($data, 'id'),
            groupId: data_get($data, 'group_id'),
            defaultBilling: data_get($data, 'default_billing'),
            defaultShipping: data_get($data, 'default_shipping'),
            confirmation: data_get($data, 'confirmation'),
            createdAt: data_get($data, 'created_at'),
            updatedAt: data_get($data, 'updated_at'),
            createdIn: data_get($data, 'created_in'),
            dob: data_get($data, 'dob'),
            middlename: data_get($data, 'middlename'),
            prefix: data_get($data, 'prefix'),
            suffix: data_get($data, 'suffix'),
            gender: data_get($data, 'gender'),
            storeId: data_get($data, 'store_id'),
            taxvat: data_get($data, 'taxvat'),
            websiteId: data_get($data, 'website_id'),
            addresses: array_map(
                Address::fromArray(...),
                data_get($data, 'addresses', [])
            ),
            disableAutoGroupChange: data_get($data, 'disable_auto_group_change'),
            customAttributes: array_map(
                CustomAttribute::fromArray(...),
                data_get($data, 'custom_attributes', [])
            ),
        );
    }
}
