@php
/**
 * @var \App\Api\Magento\GraphQl\Schema\Queries\Cart $cart
 */
@endphp
<b>Your Cart Details</b>

@if ($cart->total_quantity)
Total Quantity: {{ $cart->total_quantity }}
@endif

@if ($cart->prices && $cart->prices->grand_total)
Grand Total: {{ $cart->prices->grand_total->value }} {{ $cart->prices->grand_total->currency->value }}
@endif

@if ($cart->itemsV2 && count($cart->itemsV2->items) > 0)
<b>Items:</b>
@foreach ($cart->itemsV2->items as $item)
- {{ $item->product->name }} ({{ $item->product->sku }}) x {{ $item->quantity }}
@endforeach
@endif

@if ($cart->billing_address)
<b>Billing Address:</b>
{{ $cart->billing_address->firstname }} {{ $cart->billing_address->lastname }}
{{ implode(', ', $cart->billing_address->street) }}
{{ $cart->billing_address->city }}, {{ $cart->billing_address->postcode }}
{{ $cart->billing_address->country->label }}
@endif

@if ($cart->shipping_addresses && count($cart->shipping_addresses) > 0)
<b>Shipping Address:</b>
@foreach ($cart->shipping_addresses as $address)
{{ $address->firstname }} {{ $address->lastname }}
{{ implode(', ', $address->street) }}
{{ $address->city }}, {{ $address->postcode }}
{{ $address->country->label }}

@if ($address->selected_shipping_method)
Selected Shipping: {{ $address->selected_shipping_method->carrier_title }} - {{ $address->selected_shipping_method->method_title }} ({{ $address->selected_shipping_method->amount->value }} {{ $address->selected_shipping_method->amount->currency->value }})
@else
<b>No shipping method selected.</b>
@if (count($address->available_shipping_methods) > 0)
    Available Shipping Methods:
    @foreach ($address->available_shipping_methods as $method)
        - {{ $method->carrier_title }} - {{ $method->method_title }} ({{ $method->amount->value }} {{ $method->amount->currency->value }})
    @endforeach
@endif
@endif

@endforeach
@endif

@if ($cart->selected_payment_method?->title)
<b>Selected Payment Method:</b>
{{ $cart->selected_payment_method->title }}
@else
<b>No payment method selected.</b>
@if (count($cart->available_payment_methods) > 0)
    Available Payment Methods:
    @foreach ($cart->available_payment_methods as $method)
        - {{ $method->title }}
    @endforeach
@endif
@endif
