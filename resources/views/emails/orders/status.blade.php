<x-mail::message>
# Hello, {{ $order->user->name }}

We wanted to inform you that your order with the order number **{{ $order->order_number }}** has been updated.

## New Status: {{ $order->status }}

You can click the button below to view your order details:

<x-mail::button :url="''">
View Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
