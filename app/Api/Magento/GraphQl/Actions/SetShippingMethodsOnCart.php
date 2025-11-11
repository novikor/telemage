<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Query\CartQuery;
use App\Api\Magento\GraphQl\Schema\Queries\Cart;
use App\Api\Magento\GraphQl\Schema\Queries\CartQueryObject;
use App\Models\TelegramUser;
use GraphQL\Mutation;
use GraphQL\RawObject;
use Illuminate\Http\Client\ConnectionException;

class SetShippingMethodsOnCart extends GraphQlAction
{
    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    public function __invoke(TelegramUser $user, string $cartId, string $carrierCode, string $methodCode): Cart
    {
        $mutation = new Mutation('setShippingMethodsOnCart');
        $mutation->setArguments(['input' => new RawObject(
            sprintf(
                '
        {
      cart_id: "%s"
      shipping_methods: [{ carrier_code: "%s", method_code: "%s" }]
    }
        ', $cartId, $carrierCode, $methodCode
            )
        )]
        );

        $cartQuery = new CartQueryObject('cart');
        CartQuery::applySelection($cartQuery);

        $mutation->setSelectionSet(
            [
                $cartQuery->getQuery(),
            ]
        );

        $result = $this->query($user, $mutation)->json('data.setShippingMethodsOnCart.cart');

        return Cart::fromArray($result);
    }
}
