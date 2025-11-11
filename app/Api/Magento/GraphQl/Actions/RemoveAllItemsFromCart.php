<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Schema\NestedMutation;
use App\Api\Magento\GraphQl\Schema\Queries\Cart;
use App\Api\Magento\GraphQl\Schema\Queries\CartQueryObject;
use App\Models\TelegramUser;
use GraphQL\RawObject;
use Illuminate\Http\Client\ConnectionException;

class RemoveAllItemsFromCart extends GraphQlAction
{
    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    public function __invoke(TelegramUser $user, Cart $cart): void
    {
        $itemsToRemove = collect($cart->itemsV2->items)->pluck('uid');
        if ($itemsToRemove->isEmpty()) {
            return;
        }

        $subMutations = $itemsToRemove->map(fn (string $uid) => new NestedMutation('removeItemFromCart')
            ->setArguments(['input' => new RawObject(
                sprintf(
                    ' {cart_id: "%s", cart_item_uid: "%s"}',
                    $cart->id, $uid
                )
            )])
            ->setSelectionSet([new CartQueryObject('cart')->selectTotalQuantity()->getQuery()])
            ->setAlias($uid)
        )->reduce(fn ($carry, $item) => $carry.PHP_EOL.$item->__toString());

        $rootMutation = 'mutation removeAllItemsFromCart {'.$subMutations.'}';

        $this->query($user, $rootMutation);
    }
}
