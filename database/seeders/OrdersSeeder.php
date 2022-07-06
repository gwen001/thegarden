<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class OrdersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $t_users = User::select('id')->get();
        $n_users = count($t_users) - 1;

        $t_products = Product::all();
        $n_products = count($t_products) - 1;

        Order::factory(30)->create()->each(function($obj) use ($t_users,$n_users,$t_products,$n_products) {
            $obj->user_id = $t_users[ rand(0,$n_users) ]->id;

            $t_cart['compute'] = [ 'quantity'=>0, 'total'=>0 ];
            $n = rand(0,$n_products) + 1;

            for( $i=0 ; $i<$n ; $i++ )
            {
                $p = $t_products[ rand(0,$n_products) ];
                if( !array_key_exists($p->id,$t_cart) )
                {
                    $t_cart[$p->id]['product_id'] = $p->id;
                    $t_cart[$p->id]['quantity'] = rand( 1, 10 );
                    $t_cart[$p->id]['price'] = $p->price;
                    $t_cart[$p->id]['total'] = $t_cart[$p->id]['quantity'] * $t_cart[$p->id]['price'];
                    $t_cart['compute']['quantity'] += $t_cart[$p->id]['quantity'];
                    $t_cart['compute']['total'] += $t_cart[$p->id]['total'];
                }
            }

            $obj->amount = $t_cart['compute']['total'];
            $obj->uniqid = Order::generateUniqid();
            $obj->cart = $t_cart;
            $obj->save();
        });
    }
}
