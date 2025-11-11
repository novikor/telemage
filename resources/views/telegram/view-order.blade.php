@php
    use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrder;
/**
 * @var CustomerOrder $order
 */
@endphp

<b>Order</b> <u>#{{ $order->order_number }}</u>

<i>Status:</i> {{ $order->status }}
<i>Placed:</i> {{ $order->order_date->isToday() ? $order->order_date->fromNow() : $order->order_date->format('M d, Y')}}

<b><i>Total:</i> {{ $order->total->grand_total->currency }} {{ $order->total->grand_total->value }}</b>

@if ($order->items && count($order->items) > 0)
<b>Items:</b>
@foreach ($order->items as $item)
    - {{ $item->product_name }} ({{ $item->product_sku }}) x {{ $item->quantity_ordered }}
@endforeach
@endif

@if ($order->billing_address)
<b>Billing Address:</b>
    {{ $order->billing_address->firstname }} {{ $order->billing_address->lastname }}
    {{ implode(', ', $order->billing_address->street) }}
    {{ $order->billing_address->city }}, {{ $order->billing_address->postcode }}
    {{ $order->billing_address->country_code->value }}
@endif

@if ($order->shipping_address)
<b>Shipping Address:</b>
    {{ $order->billing_address->firstname }} {{ $order->billing_address->lastname }}
    {{ implode(', ', $order->billing_address->street) }}
    {{ $order->billing_address->city }}, {{ $order->billing_address->postcode }}
    {{ $order->billing_address->country_code->value }}
@endif

<b>Shipping Method:</b> {{ $order->shipping_method }} ({{ $order->total->shipping_handling->total_amount->currency->value }} {{ $order->total->shipping_handling->total_amount->value }})

<b>Payment Method:</b>
@foreach($order->payment_methods as $method)
{{ $method->name }}
@endforeach
