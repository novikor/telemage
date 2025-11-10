<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class BillingCartAddress
{
    public protected(set) ?string $city = null;

    public protected(set) ?string $company = null;

    public protected(set) ?CartAddressCountry $country = null;

    public protected(set) ?string $customer_notes = null;

    public protected(set) ?string $fax = null;

    public protected(set) ?string $firstname = null;

    public protected(set) ?int $id = null;

    public protected(set) ?string $lastname = null;

    public protected(set) ?string $middlename = null;

    public protected(set) ?string $postcode = null;

    public protected(set) ?string $prefix = null;

    public protected(set) ?CartAddressRegion $region = null;

    /** @var string[] */
    public protected(set) ?array $street = null;

    public protected(set) ?string $suffix = null;

    public protected(set) ?string $telephone = null;

    public protected(set) ?string $uid = null;

    public protected(set) ?string $vat_id = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['city'])) {
            $instance->city = $data['city'];
        }
        if (isset($data['company'])) {
            $instance->company = $data['company'];
        }
        if (isset($data['country'])) {
            $instance->country = CartAddressCountry::fromArray($data['country']);
        }
        if (isset($data['customer_notes'])) {
            $instance->customer_notes = $data['customer_notes'];
        }
        if (isset($data['fax'])) {
            $instance->fax = $data['fax'];
        }
        if (isset($data['firstname'])) {
            $instance->firstname = $data['firstname'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['lastname'])) {
            $instance->lastname = $data['lastname'];
        }
        if (isset($data['middlename'])) {
            $instance->middlename = $data['middlename'];
        }
        if (isset($data['postcode'])) {
            $instance->postcode = $data['postcode'];
        }
        if (isset($data['prefix'])) {
            $instance->prefix = $data['prefix'];
        }
        if (isset($data['region'])) {
            $instance->region = CartAddressRegion::fromArray($data['region']);
        }
        if (isset($data['street'])) {
            $instance->street = $data['street'];
        }
        if (isset($data['suffix'])) {
            $instance->suffix = $data['suffix'];
        }
        if (isset($data['telephone'])) {
            $instance->telephone = $data['telephone'];
        }
        if (isset($data['uid'])) {
            $instance->uid = $data['uid'];
        }
        if (isset($data['vat_id'])) {
            $instance->vat_id = $data['vat_id'];
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
        if ($this->city !== null) {
            $data['city'] = $this->city;
        }
        if ($this->company !== null) {
            $data['company'] = $this->company;
        }
        if ($this->country instanceof CartAddressCountry) {
            $data['country'] = $this->country->asArray();
        }
        if ($this->customer_notes !== null) {
            $data['customer_notes'] = $this->customer_notes;
        }
        if ($this->fax !== null) {
            $data['fax'] = $this->fax;
        }
        if ($this->firstname !== null) {
            $data['firstname'] = $this->firstname;
        }
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->lastname !== null) {
            $data['lastname'] = $this->lastname;
        }
        if ($this->middlename !== null) {
            $data['middlename'] = $this->middlename;
        }
        if ($this->postcode !== null) {
            $data['postcode'] = $this->postcode;
        }
        if ($this->prefix !== null) {
            $data['prefix'] = $this->prefix;
        }
        if ($this->region instanceof CartAddressRegion) {
            $data['region'] = $this->region->asArray();
        }
        if ($this->street !== null) {
            $data['street'] = $this->street;
        }
        if ($this->suffix !== null) {
            $data['suffix'] = $this->suffix;
        }
        if ($this->telephone !== null) {
            $data['telephone'] = $this->telephone;
        }
        if ($this->uid !== null) {
            $data['uid'] = $this->uid;
        }
        if ($this->vat_id !== null) {
            $data['vat_id'] = $this->vat_id;
        }

        return $data;
    }
}
