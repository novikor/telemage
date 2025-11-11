<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Query\CartQuery;
use App\Api\Magento\GraphQl\Schema\Queries\Cart;
use App\Api\Magento\GraphQl\Schema\Queries\RootQueryObject;
use App\Models\TelegramUser;
use Illuminate\Http\Client\ConnectionException;

class GetCustomerCart extends GraphQlAction
{
    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    public function __invoke(TelegramUser $user): Cart
    {
        $query = new RootQueryObject;
        CartQuery::applySelection($query->selectCustomerCart());

        $result = $this->query($user, $query->getQuery())->json('data.customerCart');

        return Cart::fromArray($result);
    }
}
