@extends('layout')

@section('main')
<div id="p-products-show">
    <div class="row">
        <div class="col">
            <img src="/img/products/{{ $product->image }}" class="card-img-top" alt="{{ $product->image }}">
        </div>
        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <h4>{{ Str::ucfirst($product->title) }} - {{ $product->price }}$</h4>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    {{ $product->short_descr }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form class="form-cart-add" action="{{ route('cart.add.product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Quantity:</label>
                            <div class="col-sm-3">
                                <select name="quantity" class="form-select">
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <button id="btn-cart-add" type="submit" class="btn btn-primary">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="full-descr col">
            {{ $product->full_descr }}
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#btn-cart-add').click(function(e){
        e.preventDefault();

        var form = $('.form-cart-add');

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
                // $('#flashmessage').html(data);
                // setFlashMessage( data );
                location.reload();
            }
        });
    });
</script>
@endsection
