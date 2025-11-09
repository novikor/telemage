<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrdersArgumentsObject;
use App\Api\Magento\GraphQl\Schema\Queries\RootQueryObject;
use App\Models\TelegramUser;
use Illuminate\Http\Client\ConnectionException;

class GetOrders extends GraphQlAction
{
    /**
     * @throws ApiException
     * @throws ConnectionException
     */
    public function __invoke(TelegramUser $user, int $limit = 5): void
    {
        $queryRoot = new RootQueryObject;
        $queryRoot->selectCustomer()
            ->selectOrders(new CustomerOrdersArgumentsObject()->setPageSize($limit))
            ->selectItems()
            ->selectOrderNumber();

        $this->query($user, $queryRoot->getQuery())->dd();
    }
}
