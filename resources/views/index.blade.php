@extends('layout')

@section('main')
<div id="p-home">
    @if( isset($t_search['q']) )
        <div class="row mb-5">
            <div class="col">
                Results for "<b>{!! $t_search['q'] !!}</b>"
            </div>
        </div>
    @endif
    <div class="row">
        @foreach($t_products->data as $product)
            <div class="col col-3 mb-5">
                <div class="card" style="width: 18rem;">
                    <img src="/img/products/{{ $product->image }}" class="card-img-top" alt="{{ $product->image }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::ucfirst($product->title) }} - {{ $product->price }}$</h5>
                        <p class="card-text">{{ Str::limit($product->short_descr,80) }}</p>
                        <a href="{{ route('products.show',$product->id) }}" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
