<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Actions\GetCustomerCart;
use App\Api\Magento\GraphQl\Actions\PlaceOrder;
use App\Api\Magento\GraphQl\Actions\RemoveAllItemsFromCart;
use App\Api\Magento\GraphQl\Actions\SetPaymentMethodOnCart;
use App\Api\Magento\GraphQl\Actions\SetShippingMethodsOnCart;
use App\Api\Magento\GraphQl\Schema\Queries\Cart;
use App\Api\Magento\GraphQl\Schema\Queries\SelectedPaymentMethod;
use App\Telegram\Commands\Traits\ExtractsRequestData;
use App\Telegram\Exceptions\UserSafeException;
use Illuminate\Http\Client\ConnectionException;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Conversations\InlineMenu;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;

use function view;

class CheckoutCartCommand extends InlineMenu
{
    use ExtractsRequestData;

    public function __construct(
        private readonly GetCustomerCart $getCustomerCart,
        private readonly SetShippingMethodsOnCart $setShippingMethodsOnCart,
        private readonly SetPaymentMethodOnCart $setPaymentMethodOnCart,
        private readonly PlaceOrder $placeOrder,
        private readonly RemoveAllItemsFromCart $removeAllItemsFromCart,
    ) {
        parent::__construct();
    }

    /**
     * @throws ApiException
     * @throws ConnectionException
     * @throws InvalidArgumentException
     */
    public function start(Nutgram $bot): void
    {
        $cart = $bot->get('cart') ?: $this->getCart($bot);
        $this->renderCartAndMenu($cart);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function renderCartAndMenu(Cart $cart): void
    {
        $this->clearButtons();
        $this->menuText(view('telegram.cart-details', ['cart' => $cart])->render(), [
            'parse_mode' => ParseMode::HTML,
        ]);
        $this->addButtonRow(
            InlineKeyboardButton::make('Change Shipping Method', callback_data: '@showShippingMethods'),
        );
        if ($cart->selected_payment_method instanceof SelectedPaymentMethod) {
            $this->addButtonRow(InlineKeyboardButton::make('Change Payment Method', callback_data: '@showPaymentMethods'));
        }
        if ($cart->selected_payment_method?->code && current($cart->shipping_addresses ?? [])->selected_shipping_method) {
            $this->addButtonRow(InlineKeyboardButton::make('Confirm and place order!', callback_data: '@placeOrder'));
        }
        $this->addButtonRow(InlineKeyboardButton::make('Clear Cart', callback_data: '@clearCart'));

        $this->showMenu();
    }

    /**
     * @throws InvalidArgumentException
     * @throws ApiException
     * @throws ConnectionException
     */
    public function showShippingMethods(Nutgram $bot): void
    {
        $bot->answerCallbackQuery();
        $this->clearButtons();
        $cart = $this->getCart($bot);
        $methods = $cart->shipping_addresses[0]->available_shipping_methods;
        if (! $methods) {
            $bot->sendMessage('No shipping methods available.');
            $this->next('start');

            return;
        }
        $menu = $this->menuText('Please choose a shipping method:');
        foreach ($methods as $method) {
            $methodCodes = $method->carrier_code.'|'.$method->method_code;
            $menu->addButtonRow(InlineKeyboardButton::make($method->method_title, callback_data: $methodCodes.'@selectShippingMethod'));
        }
        $menu->showMenu();
    }

    /**
     * @throws ConnectionException
     * @throws ApiException
     * @throws InvalidArgumentException
     */
    public function selectShippingMethod(Nutgram $bot): void
    {
        [$carrierCode, $methodCode] = explode('|', $bot->callbackQuery()->data);
        $cart = $this->getCart($bot);
        $cart = ($this->setShippingMethodsOnCart)($this->getTelegramUser($bot), $cart->id, $carrierCode, $methodCode);
        $bot->answerCallbackQuery(text: 'Shipping method has been saved.');
        $this->renderCartAndMenu($cart);
    }

    /**
     * @throws InvalidArgumentException
     * @throws ConnectionException
     * @throws ApiException
     */
    public function showPaymentMethods(Nutgram $bot): void
    {
        $bot->answerCallbackQuery();
        $this->clearButtons();
        $cart = $this->getCart($bot);
        $methods = $cart->available_payment_methods;
        $menu = $this->menuText('Please choose a payment method:');
        foreach ($methods as $method) {
            $menu->addButtonRow(InlineKeyboardButton::make($method->title, callback_data: $method->code.'@selectPaymentMethod'));
        }
        $menu->showMenu();
    }

    /**
     * @throws ApiException
     * @throws ConnectionException
     * @throws InvalidArgumentException
     */
    public function selectPaymentMethod(Nutgram $bot): void
    {
        $code = $bot->callbackQuery()->data;
        $cart = $this->getCart($bot);
        $cart = ($this->setPaymentMethodOnCart)(
            user: $this->getTelegramUser($bot),
            cartId: $cart->id,
            paymentMethodCode: $code
        );
        $bot->answerCallbackQuery(text: 'Payment method has been saved.');
        $this->renderCartAndMenu($cart);
    }

    /**
     * @throws ApiException
     * @throws ConnectionException
     * @throws InvalidArgumentException
     */
    public function clearCart(Nutgram $bot): void
    {
        ($this->removeAllItemsFromCart)($this->getTelegramUser($bot), $this->getCart($bot));
        $bot->answerCallbackQuery(text: 'Your cart has been cleared.');

        //        $this->next('start');
        $this->renderCartAndMenu($this->getCart($bot));
    }

    public function placeOrder(Nutgram $bot): void
    {
        $bot->answerCallbackQuery(text: 'Placing your order...');
        $cart = $this->getCart($bot);
        $orderNumber = ($this->placeOrder)($this->getTelegramUser($bot), $cart->id);
        $this->end();
        app()->call(ViewOrderCommand::class, ['bot' => $bot, 'orderNumber' => $orderNumber]);
    }

    /**
     * @throws ApiException
     * @throws ConnectionException
     * @throws InvalidArgumentException
     * @throws UserSafeException
     */
    private function getCart(Nutgram $bot): Cart
    {
        $cart = ($this->getCustomerCart)($this->getTelegramUser($bot));
        if ($cart->total_quantity === 0.0) {
            $this->end();
            throw new UserSafeException('Your shopping cart is empty.');
        }

        return $cart;
    }
}
