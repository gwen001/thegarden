@extends('layout')

@section('main')
<div id="p-carts-show">
    <div class="row">
        <div class="col-8">
            @if( count($t_cart) > 1 )
                <table class="table">
                    <tbody>
                        @foreach( $t_cart as $pkey=>$pcart )
                            @if( $pkey != 'compute' )
                                <tr>
                                    <td>
                                        <img src="/img/products/{{ $pcart['product']->image }}" alt="{{ $pcart['product']->image }}" width="100">
                                        <a href="{{ route('products.show',$pcart['product']->id) }}">{{ $pcart['product']->title }}</a>
                                    </td>
                                    <td class="text-end align-middle">{{ $pcart['product']->price }}$</td>
                                    <td class="text-end align-middle">*</td>
                                    <td class="text-center align-middle">
                                        <form class="form-cart-update" action="{{ route('cart.update.product') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $pcart['product']->id }}">
                                            <select name="quantity">
                                                <option value="0" @if($pcart['quantity'] == 0) selected @endif>0</option>
                                                <option value="1" @if($pcart['quantity'] == 1) selected @endif>1</option>
                                                <option value="2" @if($pcart['quantity'] == 2) selected @endif>2</option>
                                                <option value="3" @if($pcart['quantity'] == 3) selected @endif>3</option>
                                                <option value="4" @if($pcart['quantity'] == 4) selected @endif>4</option>
                                                <option value="5" @if($pcart['quantity'] == 5) selected @endif>5</option>
                                                <option value="6" @if($pcart['quantity'] == 6) selected @endif>6</option>
                                                <option value="7" @if($pcart['quantity'] == 7) selected @endif>7</option>
                                                <option value="8" @if($pcart['quantity'] == 8) selected @endif>8</option>
                                                <option value="9" @if($pcart['quantity'] == 9) selected @endif>9</option>
                                                <option value="10" @if($pcart['quantity'] == 10) selected @endif>10</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-end align-middle">=</td>
                                    <td class="text-end align-middle">{{ number_format($pcart['total'],2) }}$</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td class="text-end" colspan="5"><b>Total:</b></td>
                            <td class="text-end"><b>{{ number_format($t_cart['compute']['total'],2) }}$</b></td>
                        </tr>
                        <tr class="border-white">
                            <td class="text-end" colspan="10">
                                <a href="{{ route('orders.create') }}" class="btn btn-warning">Purchase</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                Your cart is empty.
            @endif
        </div>
        <div class="col-1"></div>
        <div class="col-3 text-center">
            <div class="row mb-3">
                <div class="col">
                    <h3>Total: {{ number_format($t_cart['compute']['total'],2) }}$</h3>
                </div>
            </div>
            @if( count($t_cart) > 1 )
                <div class="row mb-5">
                    <div class="col">
                        <a href="{{ route('orders.create') }}" class="btn btn-warning">Purchase</a>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col lorem">
                    Sed et est nec lectus sodales convallis non vulputate metus. Proin varius justo ut scelerisque viverra. Sed odio nisi, convallis nec sagittis ac, ornare vitae magna. Sed mauris lectus, viverra a interdum eu, tempus sed metus. Praesent quis efficitur felis, id porta risus. Vivamus ipsum risus, dignissim id vestibulum in, mattis eget tortor. Nulla facilisi.
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col blabla">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
    </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
    $('.form-cart-update > select[name=quantity]').on('change',function(e){
        var form = $(this).parent();

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            dataType: 'html',
            data: {
                _token: form.find('input[name=_token]').val(),
                product_id: form.find('input[name=product_id]').val(),
                quantity: form.find('select[name=quantity]').val()
            },
            success:function(data){
                // alert(data);
                // $('div.flash-message').html(data);
                // setFlashMessage( data );
                location.reload();
            }
        });
    });
</script>
@endsection
