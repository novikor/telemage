<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Query\CartQuery;
use App\Api\Magento\GraphQl\Schema\Queries\Cart;
use App\Api\Magento\GraphQl\Schema\Queries\CartQueryObject;
use App\Models\TelegramUser;
use GraphQL\Mutation;
use GraphQL\Query;
use Illuminate\Http\Client\ConnectionException;

class Reorder extends GraphQlAction
{
    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    public function __invoke(TelegramUser $user, string $orderNumber): Cart
    {
        $cartQuery = new CartQueryObject('cart');
        CartQuery::applySelection($cartQuery);
        $mutation = new Mutation('reorderItems')
            ->setArguments(['orderNumber' => $orderNumber])
            ->setSelectionSet([
                $cartQuery->getQuery(),
                new Query('userInputErrors')->setSelectionSet(['message', 'code']),
            ]);

        $result = $this->query($user, $mutation)->json('data.reorderItems.cart');

        return Cart::fromArray($result);
    }
}
