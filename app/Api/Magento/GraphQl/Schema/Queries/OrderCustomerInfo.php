<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class OrderCustomerInfo
{
    public protected(set) ?string $firstname = null;

    public protected(set) ?string $lastname = null;

    public protected(set) ?string $middlename = null;

    public protected(set) ?string $prefix = null;

    public protected(set) ?string $suffix = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['firstname'])) {
            $instance->firstname = $data['firstname'];
        }
        if (isset($data['lastname'])) {
            $instance->lastname = $data['lastname'];
        }
        if (isset($data['middlename'])) {
            $instance->middlename = $data['middlename'];
        }
        if (isset($data['prefix'])) {
            $instance->prefix = $data['prefix'];
        }
        if (isset($data['suffix'])) {
            $instance->suffix = $data['suffix'];
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
        if ($this->firstname !== null) {
            $data['firstname'] = $this->firstname;
        }
        if ($this->lastname !== null) {
            $data['lastname'] = $this->lastname;
        }
        if ($this->middlename !== null) {
            $data['middlename'] = $this->middlename;
        }
        if ($this->prefix !== null) {
            $data['prefix'] = $this->prefix;
        }
        if ($this->suffix !== null) {
            $data['suffix'] = $this->suffix;
        }

        return $data;
    }
}
