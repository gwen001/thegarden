<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public static function get()
    {
        // $cart = $request->session()->get('cart',null);
        $cart = Session::get('cart',null);

        if( is_null($cart) ) {
            $t_cart = [];
        } else {
            $t_cart = json_decode( $cart, true );
        }

        return $t_cart;
    }

    public static function getDatas( $load_product=true )
    {
        $t_cart = self::get();

        // if( !count($t_cart) ) {
        //     Session::flash('error', 'Your cart is empty.');
        //     // return View::make('components/flash-message');
        //     return redirect()->route('home');
        // }

        $t_cart['compute'] = [ 'quantity'=>0, 'total'=>0 ];

        foreach( $t_cart as $pkey=>$pcart ) {
            if( $pkey == 'compute' ) {
                continue;
            }
            $p = Product::find($pcart['product_id']);
            if( $load_product ) {
                $t_cart[$pkey]['product'] = $p;
            }
            $t_cart[$pkey]['price'] = $p->price;
            $t_cart[$pkey]['total'] = $t_cart[$pkey]['quantity'] * $t_cart[$pkey]['price'];
            $t_cart['compute']['quantity'] += $t_cart[$pkey]['quantity'];
            $t_cart['compute']['total'] += $t_cart[$pkey]['total'];
        }

        return $t_cart;
    }

    public static function set( $t_cart )
    {
        return Session::put('cart', json_encode($t_cart));
    }

    public static function del()
    {
        Session::forget('cart');
    }
}
