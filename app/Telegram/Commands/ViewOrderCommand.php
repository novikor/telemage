<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Actions\GetOrder;
use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrder;
use App\Telegram\Commands\Traits\ExtractsRequestData;
use Illuminate\Http\Client\ConnectionException;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;

class ViewOrderCommand
{
    use ExtractsRequestData;

    /**
     * @throws ApiException
     * @throws ConnectionException
     */
    public function __invoke(Nutgram $bot, string $orderNumber, GetOrder $getOrder): void
    {
        $order = $getOrder($this->getTelegramUser($bot), $orderNumber);
        if (! $order instanceof CustomerOrder) {
            $bot->sendMessage("Hmm, seems like order #$orderNumber doesn't exist.");

            return;
        }

        $bot->sendMessage(
            view('telegram.view-order', ['order' => $order])->render(),
            parse_mode: ParseMode::HTML,
            reply_markup: InlineKeyboardMarkup::make()
                ->addRow(
                    InlineKeyboardButton::make('Reorder', callback_data: "reorder $orderNumber"),
                )

        );
    }
}
