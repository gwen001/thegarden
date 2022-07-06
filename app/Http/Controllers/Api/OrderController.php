<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use DB;

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
        $user_id = $request->query('user_id',null);

        // if( is_null($user_id) ) {
        //     $t_datas = DB::select('SELECT * FROM orders');
        //     $t_orders = Order::orderBy('id','DESC')->get();
        // } else {
        //     $t_datas = DB::select("SELECT * FROM orders WHERE user_id='".$user_id."'");
        // }

        // $t_orders = [];
        // foreach( $t_datas as $d ) {
        //     // var_dump($d);
        //     $t_orders[] = (new Order())->fill((array)$d);
        // }

        // return OrderResource::collection($t_orders);

        if( is_null($user_id) ) {
            $t_orders = Order::orderBy('id','DESC')->get();
        } else {
            $t_orders = Order::where('user_id',$user_id)->orderBy('id','DESC')->get();
        }

        return OrderResource::collection($t_orders);
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
        $datas = $request->post();
        $datas['uniqid'] = Order::generateUniqid();
        $order = Order::create( $datas );

        return Order::find($order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $q = "SELECT * FROM orders WHERE id='".$id."'";
        // var_dump($q);
        $datas = DB::select($q);
        // var_dump($datas);

        $order = (new Order())->fill((array)$datas[0]);
        $order->created_at = $datas[0]->created_at;
        $order->card_number = base64_decode($datas[0]->card_number);
        $order->cart = json_decode($datas[0]->cart,true);
        // var_dump($order);

        $rorder = new OrderResource($order);
        $rorder['protected_card_number'] = str_repeat('*',12) . substr($order->card_number,-4);
        $rorder['protected_card_cvv'] = str_repeat('*',2) . substr($order->card_cvv,-1);
        $rorder['protected_card_expiration'] = $order->card_expiration;

        return $rorder;
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
