@extends('layout')

@section('main')
<div id="p-orders-show">
    <div class="row">
        <div class="col col-3">@include('components/user-menu',['active'=>'orders'])</div>
        <div class="col col-1"></div>
        <div class="col col-8">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Order Ref.</label>
                <div class="col-sm-7">
                    <span class="form-control-plaintext"><b>{{ $order->uniqid }}</b></span>
                </div>
                <div class="col-sm-3 text-end">
                    <a href="{{ route('orders.pdf',$order->id) }}" class="btn btn-warning">Download PDF</a>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Date:</label>
                <div class="col-sm-10">
                    <span class="form-control-plaintext">{{ date('Y-m-d H:i:s', strtotime($order->created_at)) }}</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Delivered to:</label>
                <div class="col-sm-10">
                    <span class="form-control-plaintext">{{ $order->fullname }}</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Address:</label>
                <div class="col-sm-10">
                    <span class="form-control-plaintext">{{ $order->address }}, {{ $order->zipcode }} {{ $order->city }}, {{ $order->country }}</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Card:</label>
                <div class="col-sm-10">
                    <span class="form-control-plaintext">{{ $order->protected_card_number }} - {{ $order->protected_card_cvv }} - {{ $order->protected_card_expiration }}</span>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-end" colspan="5"><b>Total:</b></td>
                                <td class="text-end"><b>{{ number_format($order->amount,2) }}$</b></td>
                            </tr>
                            @foreach( $order->cart as $pkey=>$pcart )
                                @if( $pkey != 'compute' )
                                    <tr>
                                        <td>
                                            <img src="/img/products/{{ $pcart->product->image }}" alt="{{ $pcart->product->image }}" width="100">
                                            <a href="{{ route('products.show',$pcart->product->id) }}">{{ $pcart->product->title }}</a>
                                        </td>
                                        <td class="text-end align-middle">{{ $pcart->price }}$</td>
                                        <td class="text-end align-middle">*</td>
                                        <td class="text-center align-middle">{{ $pcart->quantity }}</td>
                                        <td class="text-end align-middle">=</td>
                                        <td class="text-end align-middle">{{ number_format($pcart->total,2) }}$</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
