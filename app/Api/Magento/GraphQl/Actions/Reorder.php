<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Query\CartQuery;
use App\Api\Magento\GraphQl\Schema\NestedMutation;
use App\Api\Magento\GraphQl\Schema\Queries\Cart;
use App\Api\Magento\GraphQl\Schema\Queries\CartQueryObject;
use App\Models\TelegramUser;
use GraphQL\Mutation;
use GraphQL\Query;
use GraphQL\RawObject;
use Illuminate\Http\Client\ConnectionException;

class Reorder extends GraphQlAction
{
    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    public function __invoke(TelegramUser $user, string $orderNumber, int $shippingAddressId, int $billingAddressId): Cart
    {
        $cartQuery = new CartQueryObject('cart');
        CartQuery::applySelection($cartQuery);
        $reorderMutation = new Mutation('reorderItems')
            ->setArguments(['orderNumber' => $orderNumber])
            ->setSelectionSet([
                $cartQuery->getQuery(),
                new Query('userInputErrors')->setSelectionSet(['message', 'code']),
            ]);

        $result = $this->query($user, $reorderMutation)->json('data.reorderItems.cart');
        $cart = Cart::fromArray($result);

        $setShippingAddressesOnCart = new NestedMutation('setShippingAddressesOnCart');
        $setShippingAddressesOnCart->setArguments(['input' => new RawObject(
            sprintf(
                '{cart_id: "%s", shipping_addresses: [{customer_address_id: %d}]}',
                $cart->id,
                $shippingAddressId
            )
        )])->setSelectionSet([
            tap(
                new CartQueryObject('cart'),
                fn (CartQueryObject $cartQuery) => $cartQuery->selectShippingAddresses()->selectId()
            )->getQuery(),
        ]);

        $setBillingAddressOnCart = new NestedMutation('setBillingAddressOnCart');
        $setBillingAddressOnCart->setArguments(['input' => new RawObject(
            sprintf(
                '{cart_id: "%s", billing_address: {customer_address_id: %d}}',
                $cart->id,
                $billingAddressId
            )
        )])->setSelectionSet([
            $cartQuery->getQuery(),
        ]);

        $rootMutation = sprintf(
            "mutation setAddresses \n {\n shipping: %s \n billing: %s \n}",
            $setShippingAddressesOnCart->__toString(),
            $setBillingAddressOnCart->__toString()
        );

        $result = $this->query($user, $rootMutation)->json('data.billing.cart');

        return Cart::fromArray($result);
    }
}
