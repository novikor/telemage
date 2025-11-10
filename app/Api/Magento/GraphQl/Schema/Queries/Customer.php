<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use Carbon\Carbon;

class Customer
{
    /** @var CustomerAddress[] */
    public protected(set) ?array $addresses = null;

    public protected(set) ?CustomerAddresses $addressesV2 = null;

    public protected(set) ?bool $allow_remote_shopping_assistance = null;

    public protected(set) ?CompareList $compare_list = null;

    public protected(set) ?ConfirmationStatusEnumEnumObject $confirmation_status = null;

    public protected(set) ?Carbon $created_at = null;

    /** @var mixed[] */
    public protected(set) ?array $custom_attributes = null;

    public protected(set) ?string $date_of_birth = null;

    public protected(set) ?string $default_billing = null;

    public protected(set) ?string $default_shipping = null;

    public protected(set) ?string $dob = null;

    public protected(set) ?string $email = null;

    public protected(set) ?string $firstname = null;

    public protected(set) ?int $gender = null;

    public protected(set) ?int $group_id = null;

    public protected(set) ?int $id = null;

    public protected(set) ?bool $is_subscribed = null;

    public protected(set) ?string $lastname = null;

    public protected(set) ?string $middlename = null;

    public protected(set) ?CustomerOrders $orders = null;

    public protected(set) ?string $prefix = null;

    public protected(set) ?ProductReviews $reviews = null;

    public protected(set) ?string $suffix = null;

    public protected(set) ?string $taxvat = null;

    public protected(set) ?Wishlist $wishlist = null;

    public protected(set) ?Wishlist $wishlist_v2 = null;

    /** @var Wishlist[] */
    public protected(set) ?array $wishlists = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['addresses'])) {
            $instance->addresses = array_map(CustomerAddress::fromArray(...), $data['addresses']);
        }
        if (isset($data['addressesV2'])) {
            $instance->addressesV2 = CustomerAddresses::fromArray($data['addressesV2']);
        }
        if (isset($data['allow_remote_shopping_assistance'])) {
            $instance->allow_remote_shopping_assistance = $data['allow_remote_shopping_assistance'];
        }
        if (isset($data['compare_list'])) {
            $instance->compare_list = CompareList::fromArray($data['compare_list']);
        }
        if (isset($data['confirmation_status'])) {
            $instance->confirmation_status = $data['confirmation_status'];
        }
        if (isset($data['created_at'])) {
            $instance->created_at = new Carbon($data['created_at']);
        }
        if (isset($data['custom_attributes'])) {
            $instance->custom_attributes = $data['custom_attributes'];
        }
        if (isset($data['date_of_birth'])) {
            $instance->date_of_birth = $data['date_of_birth'];
        }
        if (isset($data['default_billing'])) {
            $instance->default_billing = $data['default_billing'];
        }
        if (isset($data['default_shipping'])) {
            $instance->default_shipping = $data['default_shipping'];
        }
        if (isset($data['dob'])) {
            $instance->dob = $data['dob'];
        }
        if (isset($data['email'])) {
            $instance->email = $data['email'];
        }
        if (isset($data['firstname'])) {
            $instance->firstname = $data['firstname'];
        }
        if (isset($data['gender'])) {
            $instance->gender = $data['gender'];
        }
        if (isset($data['group_id'])) {
            $instance->group_id = $data['group_id'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['is_subscribed'])) {
            $instance->is_subscribed = $data['is_subscribed'];
        }
        if (isset($data['lastname'])) {
            $instance->lastname = $data['lastname'];
        }
        if (isset($data['middlename'])) {
            $instance->middlename = $data['middlename'];
        }
        if (isset($data['orders'])) {
            $instance->orders = CustomerOrders::fromArray($data['orders']);
        }
        if (isset($data['prefix'])) {
            $instance->prefix = $data['prefix'];
        }
        if (isset($data['reviews'])) {
            $instance->reviews = ProductReviews::fromArray($data['reviews']);
        }
        if (isset($data['suffix'])) {
            $instance->suffix = $data['suffix'];
        }
        if (isset($data['taxvat'])) {
            $instance->taxvat = $data['taxvat'];
        }
        if (isset($data['wishlist'])) {
            $instance->wishlist = Wishlist::fromArray($data['wishlist']);
        }
        if (isset($data['wishlist_v2'])) {
            $instance->wishlist_v2 = Wishlist::fromArray($data['wishlist_v2']);
        }
        if (isset($data['wishlists'])) {
            $instance->wishlists = array_map(Wishlist::fromArray(...), $data['wishlists']);
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
        if ($this->addresses !== null) {
            $data['addresses'] = array_map(fn (CustomerAddress $item) => $item->asArray(), $this->addresses);
        }
        if ($this->addressesV2 instanceof CustomerAddresses) {
            $data['addressesV2'] = $this->addressesV2->asArray();
        }
        if ($this->allow_remote_shopping_assistance !== null) {
            $data['allow_remote_shopping_assistance'] = $this->allow_remote_shopping_assistance;
        }
        if ($this->compare_list instanceof CompareList) {
            $data['compare_list'] = $this->compare_list->asArray();
        }
        if ($this->confirmation_status instanceof ConfirmationStatusEnumEnumObject) {
            $data['confirmation_status'] = $this->confirmation_status;
        }
        if ($this->created_at instanceof Carbon) {
            $data['created_at'] = $this->created_at->toIso8601String();
        }
        if ($this->custom_attributes !== null) {
            $data['custom_attributes'] = $this->custom_attributes;
        }
        if ($this->date_of_birth !== null) {
            $data['date_of_birth'] = $this->date_of_birth;
        }
        if ($this->default_billing !== null) {
            $data['default_billing'] = $this->default_billing;
        }
        if ($this->default_shipping !== null) {
            $data['default_shipping'] = $this->default_shipping;
        }
        if ($this->dob !== null) {
            $data['dob'] = $this->dob;
        }
        if ($this->email !== null) {
            $data['email'] = $this->email;
        }
        if ($this->firstname !== null) {
            $data['firstname'] = $this->firstname;
        }
        if ($this->gender !== null) {
            $data['gender'] = $this->gender;
        }
        if ($this->group_id !== null) {
            $data['group_id'] = $this->group_id;
        }
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->is_subscribed !== null) {
            $data['is_subscribed'] = $this->is_subscribed;
        }
        if ($this->lastname !== null) {
            $data['lastname'] = $this->lastname;
        }
        if ($this->middlename !== null) {
            $data['middlename'] = $this->middlename;
        }
        if ($this->orders instanceof CustomerOrders) {
            $data['orders'] = $this->orders->asArray();
        }
        if ($this->prefix !== null) {
            $data['prefix'] = $this->prefix;
        }
        if ($this->reviews instanceof ProductReviews) {
            $data['reviews'] = $this->reviews->asArray();
        }
        if ($this->suffix !== null) {
            $data['suffix'] = $this->suffix;
        }
        if ($this->taxvat !== null) {
            $data['taxvat'] = $this->taxvat;
        }
        if ($this->wishlist instanceof Wishlist) {
            $data['wishlist'] = $this->wishlist->asArray();
        }
        if ($this->wishlist_v2 instanceof Wishlist) {
            $data['wishlist_v2'] = $this->wishlist_v2->asArray();
        }
        if ($this->wishlists !== null) {
            $data['wishlists'] = array_map(fn (Wishlist $item) => $item->asArray(), $this->wishlists);
        }

        return $data;
    }
}
