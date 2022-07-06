<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $t_search = [];
        $t_search['user_id'] = $user->id;

        $response = Http::get(env('API_URL').'/orders',$t_search);
        // var_dump($response);
        $t_orders = $response->object();

        if( !$response->ok() ) {
            // ???
        }

        return view('orders.index', compact('t_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $t_cart = Cart::getDatas();

        return view('orders.create', compact('t_cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $t_datas = $request->validate([
            'fullname' => 'required|max:64',
            'address' => 'required|max:255',
            'zipcode' => 'required|max:16',
            'city' => 'required|max:64',
            'country' => 'required|max:64',
            'card_number' => 'required|max:16',
            'card_expiration' => 'required|max:5',
            'card_cvv' => 'required|max:3',
        ]);

        $t_cart = Cart::getDatas(false);
        // var_dump($t_cart);

        if( count($t_cart) <= 1 ) {
            Session::flash('error', 'Something went wrong!');
            return redirect()->route('cart.show');
        }

        $t_datas['user_id'] = $user->id;
        $t_datas['amount'] = $t_cart['compute']['total'];
        $t_datas['cart'] = $t_cart;
        // $t_datas['cart'] = json_encode($t_cart);
        // var_dump($t_datas);

        $response = Http::post(env('API_URL').'/orders', $t_datas);

        if( $response->ok() ) {
            Cart::del();
            Session::flash('success', 'Order confirmed.');
            return redirect()->route('orders.index');
        } else {
            Session::flash('error', 'Something went wrong!');
            return redirect()->route('orders.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get(env('API_URL').'/orders/'.$id);

        if( !$response->ok() ) {
            return abort(404);
        }

        $order = $response->object()->data;

        foreach( $order->cart as $pkey=>$pcart )
        {
            if( $pkey == 'compute' ) {
                continue;
            }
            $order->cart->$pkey->product = Product::find($pcart->product_id);
        }
        // var_dump($order);

        return view('orders.show', compact('order'));
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
