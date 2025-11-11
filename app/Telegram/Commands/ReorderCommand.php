<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Actions\Reorder;
use App\Services\Api\Magento\CustomerService;
use App\Telegram\Commands\Traits\ExtractsRequestData;
use Illuminate\Http\Client\ConnectionException;
use SergiX44\Nutgram\Nutgram;

class ReorderCommand
{
    use ExtractsRequestData;

    public function __construct(
        protected CustomerService $customerService,
    ) {}

    /**
     * @throws ApiException
     * @throws ConnectionException
     */
    public function __invoke(Nutgram $bot, string $orderNumber, Reorder $reorder): void
    {
        $telegramUser = $this->getTelegramUser($bot);
        $customer = $this->customerService->getCustomerData($telegramUser);

        if (! $customer->defaultShipping || ! $customer->defaultBilling) {
            $bot->answerCallbackQuery(text: 'Please set your default shipping and billing addresses first.');
            $bot->sendMessage(
                sprintf(
                    'Please set your default shipping and billing addresses first by visiting %s.',
                    $telegramUser->integration->magento_base_url.'/customer/address/'
                )
            );

            return;
        }

        $cart = $reorder($telegramUser, $orderNumber, (int) $customer->defaultShipping, (int) $customer->defaultBilling);

        $bot->set('cart', $cart);
        $bot->answerCallbackQuery(text: 'Yep, reordering!');

        app()->call(CheckoutCartCommand::class, ['bot' => $bot]);
    }
}
