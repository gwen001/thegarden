<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Storage;
use PDF;
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

        $response = Http::withHeaders(['Authorization'=>'Bearer '.$user->api_token])->get(env('API_URL').'/orders');
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

        $response = Http::withHeaders(['Authorization'=>'Bearer '.$user->api_token])->post(env('API_URL').'/orders', $t_datas);

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
        $user = Auth::user();
        $response = Http::withHeaders(['Authorization'=>'Bearer '.$user->api_token])->get(env('API_URL').'/orders/'.$id);

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

    /**
     * Generate PDF of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $user = Auth::user();
        $response = Http::withHeaders(['Authorization'=>'Bearer '.$user->api_token])->get(env('API_URL').'/orders/'.$id);

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

        $m1 = preg_match_all( '#<iframe.*></iframe>#', $order->address, $t_iframes, PREG_OFFSET_CAPTURE );
        $m2 = preg_match_all( '#<object.*></object>#', $order->address, $t_objects, PREG_OFFSET_CAPTURE );
        $t_results = array_merge( $t_iframes, $t_objects );
        if( $m1 || $m2 ) {
            // var_dump($t_results);

            $m = preg_match_all( '#src=["\']?([^"\'> ]+)["\']?#', $t_results[0][0][0], $tmp );

            if( $m )
            {
                $url = $tmp[1][0];
                // $url = '/etc/hosts';
                // $url = 'http://10degres.net/assets/img/avatar.jpg';
                // $url = 'file:///etc/hosts';
                // $url = 'http://127.0.0.1';

                $start = substr( $order->address, 0, $t_results[0][0][1] );
                $end = substr( $order->address, $t_results[0][0][1]+strlen($t_results[0][0][0]) );
                // var_dump($start);
                // var_dump($end);
                // var_dump($url);

                $content = @file_get_contents( $url );

                if( stripos($url,'http') === 0 ) {
                    $t_headers = get_headers($url);
                    foreach( $t_headers as $h ) {
                        if( stripos($h,'content-type') === 0 ) {
                            $mime = $h;
                        }
                    }
                } else {
                    $mime = mime_content_type($url);
                }
                // var_dump($mime);

                if( strpos($mime,'image/') !== false ) {
                    $content = '<img src="data:image/png;base64,'.base64_encode($content).'">';
                }
                // var_dump($content);

                $address = $start;
                $address .= '<table border="1"><tr><td>'.$content.'</td></tr></table>';
                $address .= $end;
                // var_dump($address);

                $order->address = $address;
            }
        }

        $pdf = PDF::loadView('orders/pdf', compact('order'));
        return $pdf->download('invoice.pdf');
    }
}
