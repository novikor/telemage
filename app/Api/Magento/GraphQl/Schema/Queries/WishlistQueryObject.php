<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class WishlistQueryObject extends QueryObject
{
    const OBJECT_NAME = 'Wishlist';

    public function selectId(): static
    {
        $this->selectField('id');

        return $this;
    }

    #[\Deprecated(message: 'Use the `items_v2` field instead.')]
    public function selectItems(?WishlistItemsArgumentsObject $argsObject = null): WishlistItemQueryObject
    {
        $object = new WishlistItemQueryObject('items');
        if ($argsObject instanceof WishlistItemsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectItemsCount(): static
    {
        $this->selectField('items_count');

        return $this;
    }

    public function selectItemsV2(?WishlistItemsV2ArgumentsObject $argsObject = null): WishlistItemsQueryObject
    {
        $object = new WishlistItemsQueryObject('items_v2');
        if ($argsObject instanceof WishlistItemsV2ArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSharingCode(): static
    {
        $this->selectField('sharing_code');

        return $this;
    }

    public function selectUpdatedAt(): static
    {
        $this->selectField('updated_at');

        return $this;
    }
}
