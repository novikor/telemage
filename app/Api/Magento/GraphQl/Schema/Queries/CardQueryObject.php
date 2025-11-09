<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CardQueryObject extends QueryObject
{
    const OBJECT_NAME = 'Card';

    public function selectBinDetails(?CardBinDetailsArgumentsObject $argsObject = null): CardBinQueryObject
    {
        $object = new CardBinQueryObject('bin_details');
        if ($argsObject instanceof CardBinDetailsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCardExpiryMonth(): static
    {
        $this->selectField('card_expiry_month');

        return $this;
    }

    public function selectCardExpiryYear(): static
    {
        $this->selectField('card_expiry_year');

        return $this;
    }

    public function selectLastDigits(): static
    {
        $this->selectField('last_digits');

        return $this;
    }

    public function selectName(): static
    {
        $this->selectField('name');

        return $this;
    }
}
