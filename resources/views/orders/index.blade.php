@extends('layout')

@section('main')
<div id="p-orders-index">
    <div class="row">
        <div class="col col-3">@include('components/user-menu',['active'=>'orders'])</div>
        <div class="col col-1"></div>
        <div class="col col-8">
            <table class="table table-hover">
                <tbody>
                    @foreach( $t_orders->data as $order )
                        <tr>
                            <td>{{ $order->uniqid }}</td>
                            <td class="text-center">{{ date('Y-m-d H:i:s', strtotime($order->created_at)) }}</td>
                            <td class="text-end">{{ $order->amount }}$</td>
                            <td class="text-end"><a href="{{ route('orders.show',$order->id) }}">details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
