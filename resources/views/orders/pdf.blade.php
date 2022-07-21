<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <table class="table table-bordered">
            <tr>
                <td>Order Ref.: <b>{{ $order->uniqid }}</b></td>
            </tr>
            <tr>
                <td>Date: {{ date('Y-m-d H:i:s', strtotime($order->created_at)) }}</td>
            </tr>
            <tr>
                <td>Delivered to: {!! $order->fullname !!}</td>
            </tr>
            <tr>
                <td>Address: {!! $order->address !!}, {{ $order->zipcode }} {{ $order->city }}, {{ $order->country }}</td>
            </tr>
            <tr>
                <td>Card: {{ $order->protected_card_number }} - {{ $order->protected_card_cvv }} - {{ $order->protected_card_expiration }}</td>
            </tr>
        </table>
    </body>
</html>
