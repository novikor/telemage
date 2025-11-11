<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Actions\Reorder;
use App\Telegram\Commands\Traits\ExtractsRequestData;
use Illuminate\Http\Client\ConnectionException;
use SergiX44\Nutgram\Nutgram;

class ReorderCommand
{
    use ExtractsRequestData;

    /**
     * @throws ApiException
     * @throws ConnectionException
     */
    public function __invoke(Nutgram $bot, string $orderNumber, Reorder $reorder): void
    {
        $reorder($this->getTelegramUser($bot), $orderNumber); // Never ask me why, Magento sucks and can't do it
        $cart = $reorder($this->getTelegramUser($bot), $orderNumber); // From a single request

        $bot->set('cart', $cart);
        $bot->answerCallbackQuery(text: 'Yep, reordering!');

        app()->call(CheckoutCartCommand::class, ['bot' => $bot]);
    }
}
