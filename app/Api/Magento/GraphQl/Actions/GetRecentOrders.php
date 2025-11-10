<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrder;
use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrdersArgumentsObject;
use App\Api\Magento\GraphQl\Schema\Queries\RootQueryObject;
use App\Models\TelegramUser;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;

class GetRecentOrders extends GraphQlAction
{
    /**
     * @return Collection<CustomerOrder>
     *
     * @throws ConnectionException
     * @throws ApiException
     */
    public function __invoke(TelegramUser $user, int $limit = 5): Collection
    {
        $queryRoot = new RootQueryObject;
        $orders = $queryRoot->selectCustomer()
            ->selectOrders(new CustomerOrdersArgumentsObject()->setPageSize($limit))
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

        $ordersData = $this->query($user, $queryRoot->getQuery())->json('data.customer.orders.items');

        return collect(array_map(CustomerOrder::fromArray(...), $ordersData));
    }
}
