@php
    use App\Api\Magento\GraphQl\Schema\Queries\CustomerOrder;
/**
 * @var Illuminate\Support\Collection<CustomerOrder> $orders
 */
@endphp

<b>{{ $orders->count() }} most recent {{ Str::plural('order', $orders->count()) }}</b>

@foreach ($orders as $order)
    <b>Order</b> <u>#{{ $order->order_number }}</u>
    <i>Placed on:</i> {{ $order->order_date->format('M d, Y') }}
    <i>Total:</i> {{ $order->total->grand_total->currency }}{{ $order->total->grand_total->value }}
    <i>Status:</i> {{ $order->status }}
@endforeach
