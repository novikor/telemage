<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrderQueryObject;
use App\Models\TelegramUser;
use GraphQL\Mutation;
use GraphQL\RawObject;
use Illuminate\Http\Client\ConnectionException;

class PlaceOrder extends GraphQlAction
{
    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    public function __invoke(TelegramUser $user, string $cartId): string
    {
        $mutation = new Mutation('placeOrder');
        $mutation->setArguments(['input' => new RawObject("{cart_id: \"$cartId\"}")]);

        $mutation->setSelectionSet(
            [
                new CustomerOrderQueryObject('orderV2')
                    ->selectOrderNumber()->getQuery(),
                'errors { message }',
            ]
        );

        return $this->query($user, $mutation)->json('data.placeOrder.orderV2.order_number');
    }
}
