<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrder;
use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrdersArgumentsObject;
use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrdersFilterInputInputObject;
use App\Api\Magento\GraphQl\Schema\Queries\FilterStringTypeInputInputObject;
use App\Api\Magento\GraphQl\Schema\Queries\RootQueryObject;
use App\Models\TelegramUser;
use Illuminate\Http\Client\ConnectionException;

class GetOrder extends GraphQlAction
{
    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    public function __invoke(TelegramUser $user, string $orderNumber): ?CustomerOrder
    {
        $queryRoot = new RootQueryObject;
        $orders = $queryRoot->selectCustomer()
            ->selectOrders(new CustomerOrdersArgumentsObject()->setFilter(
                new CustomerOrdersFilterInputInputObject()->setNumber(
                    new FilterStringTypeInputInputObject()->setEq($orderNumber)
                )
            ))
            ->selectItems()
            ->selectStatus()
            ->selectOrderNumber()
            ->selectOrderDate();
        $orders->selectTotal()->selectGrandTotal()
            ->selectCurrency()->selectValue();
        $orders->selectItems()
            ->selectQuantityOrdered()
            ->selectProductName()
            ->selectProductSalePrice()->selectCurrency()->selectValue();

        $order = $this->query($user, $queryRoot->getQuery())->json('data.customer.orders.items.0');
        if ($order === null) {
            return null;
        }

        return CustomerOrder::fromArray($order);
    }
}
