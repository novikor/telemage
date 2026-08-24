<?php

declare(strict_types=1);

namespace Tests\Feature\TelegramCommands;

use App\Api\ApiException;
use App\Api\Magento\GraphQl\Actions\GetCustomerCart;
use App\Api\Magento\GraphQl\Actions\PlaceOrder;
use App\Api\Magento\GraphQl\Actions\RemoveAllItemsFromCart;
use App\Api\Magento\GraphQl\Actions\SetPaymentMethodOnCart;
use App\Api\Magento\GraphQl\Actions\SetShippingMethodsOnCart;
use App\Api\Magento\GraphQl\Schema\Queries\Cart;
use App\Models\Integration;
use App\Models\TelegramUser;
use App\Telegram\Commands\CheckoutCartCommand;
use App\Telegram\Exceptions\UserSafeException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use Mockery;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ChatType;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;
use SergiX44\Nutgram\Testing\FakeNutgram;

function checkoutCartBot(TelegramUser $customer, GetCustomerCart $getCustomerCart): FakeNutgram
{
    $bot = Nutgram::fake();
    $bot->set('integration', $customer->integration);
    $bot->set('customer', $customer);
    $bot->getContainer()->set(GetCustomerCart::class, $getCustomerCart);
    bindUnusedCheckoutActions($bot);
    $bot->onCommand('cart', CheckoutCartCommand::class);

    return $bot->setCommonChat(Chat::make($customer->chat_id, ChatType::PRIVATE));
}

function bindUnusedCheckoutActions(FakeNutgram $bot): void
{
    foreach ([
        SetShippingMethodsOnCart::class,
        SetPaymentMethodOnCart::class,
        PlaceOrder::class,
        RemoveAllItemsFromCart::class,
    ] as $action) {
        $mock = Mockery::mock($action);
        $mock->expects('__invoke')->never();
        $bot->getContainer()->set($action, $mock);
    }
}

beforeEach(function () {
    Http::preventStrayRequests();
    test()->integration = Integration::factory()->create(['bot_token' => null]);
    test()->customer = TelegramUser::factory()->for(test()->integration)->create();
});

it('renders a customer cart without making a Magento request', function () {
    $cart = Cart::fromArray([
        'id' => 'cart-id',
        'total_quantity' => 2.0,
        'available_payment_methods' => [],
    ]);
    $getCustomerCart = Mockery::mock(GetCustomerCart::class);
    $getCustomerCart->expects('__invoke')->once()->with(test()->customer)->andReturn($cart);

    checkoutCartBot(test()->customer, $getCustomerCart)
        ->hearText('/cart')
        ->reply()
        ->assertRaw(function (Request $request): bool {
            $data = FakeNutgram::getActualData($request);

            return $request->getUri()->getPath() === 'sendMessage'
                && str_contains($data['text'], '<b>Your Cart Details</b>')
                && str_contains($data['text'], 'Total Quantity: 2')
                && str_contains($data['text'], '<b>No payment method selected.</b>')
                && $data['parse_mode'] === 'HTML'
                && count($data['reply_markup']['inline_keyboard']) === 2;
        });
});

it('propagates a graphql failure while loading the cart', function () {
    $getCustomerCart = Mockery::mock(GetCustomerCart::class);
    $getCustomerCart->expects('__invoke')
        ->once()
        ->with(test()->customer)
        ->andThrow(new ApiException('Magento GraphQL failed'));

    checkoutCartBot(test()->customer, $getCustomerCart)
        ->hearText('/cart')
        ->reply();
})->throws(ApiException::class, 'Magento GraphQL failed');

it('rejects an empty customer cart', function () {
    $cart = Cart::fromArray([
        'id' => 'cart-id',
        'total_quantity' => 0.0,
    ]);
    $getCustomerCart = Mockery::mock(GetCustomerCart::class);
    $getCustomerCart->expects('__invoke')->once()->with(test()->customer)->andReturn($cart);

    checkoutCartBot(test()->customer, $getCustomerCart)
        ->hearText('/cart')
        ->reply();
})->throws(UserSafeException::class, 'Your shopping cart is empty.');
