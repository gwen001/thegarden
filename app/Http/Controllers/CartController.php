<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{

    /**
     * Add an item to cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    {
        Session::forget('success');
        Session::forget('error');
        // Session::forget('cart');

        $product_id = (int)$request->input('product_id', 0);
        $product = Product::find($product_id);
        if( !$product ) {
            Session::flash('error', 'Product not found!');
           return View::make('components/flash-message');
        }

        $quantity = (int)$request->input('quantity', 0);
        if( $quantity <= 0 || $quantity > 10 ) {
            Session::flash('error', 'Wrong quantity!');
            return View::make('components/flash-message');
        }

        $pkey = null;
        $t_cart = Cart::get();

        foreach( $t_cart as $k=>$v ) {
            if( $v['product_id'] == $product_id ) {
                $pkey = $k;
            }
        }

        if( is_null($pkey) ) {
            $t_cart[] = [ 'product_id' => $product_id, 'quantity' => $quantity ];
        } else {
            $t_cart[$pkey]['quantity'] += $quantity;
        }

        Cart::set( $t_cart );

        Session::flash('success', 'Added to cart.');
        return View::make('components/flash-message');
    }

    /**
     * Update an item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request)
    {
        Session::forget('success');
        Session::forget('error');
        // Session::forget('cart');

        $product_id = (int)$request->input('product_id', 0);
        $product = Product::find($product_id);
        if( !$product ) {
            Session::flash('error', 'Product not found!');
           return View::make('components/flash-message');
        }

        $quantity = (int)$request->input('quantity', 0);
        if( $quantity < 0 || $quantity > 10 ) {
            Session::flash('error', 'Wrong quantity!');
            return View::make('components/flash-message');
        }

        $pkey = null;
        $t_cart = Cart::get();

        foreach( $t_cart as $k=>$v ) {
            if( $v['product_id'] == $product_id ) {
                $pkey = $k;
            }
        }

        if( is_null($pkey) ) {
            if( $quantity > 0 ) {
                $t_cart[] = [ 'product_id' => $product_id, 'quantity' => $quantity ];
            }
        } else {
            if( $quantity == 0 ) {
                unset( $t_cart[$pkey] );
            } else {
                $t_cart[$pkey]['quantity'] = $quantity;
            }
        }

        Cart::set( $t_cart );

        Session::flash('success', 'Cart updated.');
        return View::make('components/flash-message');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Request $request)
    {
        $t_cart = Cart::getDatas();

        return view('carts/show', compact('t_cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
