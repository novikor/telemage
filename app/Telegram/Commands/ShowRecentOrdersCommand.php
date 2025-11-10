<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Api\Magento\GraphQl\Actions\GetRecentOrders;
use App\Telegram\Commands\Traits\ExtractsRequestData;
use SergiX44\Nutgram\Conversations\InlineMenu;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;

class ShowRecentOrdersCommand extends InlineMenu
{
    use ExtractsRequestData;

    public function __construct(
        private readonly GetRecentOrders $getRecentOrders,
    ) {
        parent::__construct();
    }

    public function start(Nutgram $bot): void
    {
        $orders = ($this->getRecentOrders)($this->getTelegramUser($bot));
        if ($orders->isEmpty()) {
            $bot->sendMessage('You have no recent orders.');
            $this->end();

            return;
        }

        $menu = $this->menuText(view('telegram.recent-orders', ['orders' => $orders])->render(), [
            'parse_mode' => ParseMode::HTML,
        ]);

        // Add one button row per order using real order numbers as labels and callback data
        foreach ($orders as $order) {
            $label = '#'.$order->order_number;
            $callbackData = (string) $order->order_number;

            $menu->addButtonRow(
                InlineKeyboardButton::make($label, callback_data: $callbackData.'@viewOrder')
            );
        }

        $menu->showMenu();
    }

    /** @noinspection PhpUnused */
    public function viewOrder(Nutgram $bot): void
    {
        $order = $bot->callbackQuery()->data;

        app()->call(ViewOrderCommand::class, ['bot' => $bot, 'orderNumber' => $order]);
    }
}
