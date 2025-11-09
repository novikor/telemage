<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerQueryObject extends QueryObject
{
    const OBJECT_NAME = 'Customer';

    public function selectAddresses(?CustomerAddressesArgumentsObject $argsObject = null): CustomerAddressQueryObject
    {
        $object = new CustomerAddressQueryObject('addresses');
        if ($argsObject instanceof CustomerAddressesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAddressesV2(?CustomerAddressesV2ArgumentsObject $argsObject = null): CustomerAddressesQueryObject
    {
        $object = new CustomerAddressesQueryObject('addressesV2');
        if ($argsObject instanceof CustomerAddressesV2ArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAllowRemoteShoppingAssistance(): static
    {
        $this->selectField('allow_remote_shopping_assistance');

        return $this;
    }

    public function selectCompareList(?CustomerCompareListArgumentsObject $argsObject = null): CompareListQueryObject
    {
        $object = new CompareListQueryObject('compare_list');
        if ($argsObject instanceof CustomerCompareListArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectConfirmationStatus(): static
    {
        $this->selectField('confirmation_status');

        return $this;
    }

    public function selectCreatedAt(): static
    {
        $this->selectField('created_at');

        return $this;
    }

    public function selectDateOfBirth(): static
    {
        $this->selectField('date_of_birth');

        return $this;
    }

    public function selectDefaultBilling(): static
    {
        $this->selectField('default_billing');

        return $this;
    }

    public function selectDefaultShipping(): static
    {
        $this->selectField('default_shipping');

        return $this;
    }

    #[\Deprecated(message: 'Use `date_of_birth` instead.')]
    public function selectDob(): static
    {
        $this->selectField('dob');

        return $this;
    }

    public function selectEmail(): static
    {
        $this->selectField('email');

        return $this;
    }

    public function selectFirstname(): static
    {
        $this->selectField('firstname');

        return $this;
    }

    public function selectGender(): static
    {
        $this->selectField('gender');

        return $this;
    }

    #[\Deprecated(message: 'Customer group should not be exposed in the storefront scenarios.')]
    public function selectGroupId(): static
    {
        $this->selectField('group_id');

        return $this;
    }

    #[\Deprecated(message: '`id` is not needed as part of `Customer`, because on the server side, it can be identified based on the customer token used for authentication. There is no need to know customer ID on the client side.')]
    public function selectId(): static
    {
        $this->selectField('id');

        return $this;
    }

    public function selectIsSubscribed(): static
    {
        $this->selectField('is_subscribed');

        return $this;
    }

    public function selectLastname(): static
    {
        $this->selectField('lastname');

        return $this;
    }

    public function selectMiddlename(): static
    {
        $this->selectField('middlename');

        return $this;
    }

    public function selectOrders(?CustomerOrdersArgumentsObject $argsObject = null): CustomerOrdersQueryObject
    {
        $object = new CustomerOrdersQueryObject('orders');
        if ($argsObject instanceof CustomerOrdersArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrefix(): static
    {
        $this->selectField('prefix');

        return $this;
    }

    public function selectReviews(?CustomerReviewsArgumentsObject $argsObject = null): ProductReviewsQueryObject
    {
        $object = new ProductReviewsQueryObject('reviews');
        if ($argsObject instanceof CustomerReviewsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSuffix(): static
    {
        $this->selectField('suffix');

        return $this;
    }

    public function selectTaxvat(): static
    {
        $this->selectField('taxvat');

        return $this;
    }

    #[\Deprecated(message: 'Use `Customer.wishlists` or `Customer.wishlist_v2` instead.')]
    public function selectWishlist(?CustomerWishlistArgumentsObject $argsObject = null): WishlistQueryObject
    {
        $object = new WishlistQueryObject('wishlist');
        if ($argsObject instanceof CustomerWishlistArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWishlistV2(?CustomerWishlistV2ArgumentsObject $argsObject = null): WishlistQueryObject
    {
        $object = new WishlistQueryObject('wishlist_v2');
        if ($argsObject instanceof CustomerWishlistV2ArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWishlists(?CustomerWishlistsArgumentsObject $argsObject = null): WishlistQueryObject
    {
        $object = new WishlistQueryObject('wishlists');
        if ($argsObject instanceof CustomerWishlistsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
