<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $t_products = [
            [
                'title' => 'Apples',
                'short_descr' => 'Red, healthy, sweet and tasty, just like me.',
                'image' => 'apple.jpg',
            ],
            [
                'title' => 'Avocados',
                'short_descr' => 'Holy Moly that Guacamole is killing me softly.',
                'image' => 'avocado.jpg',
            ],
            [
                'title' => 'Bananas',
                'short_descr' => 'Take care or you\'ll turn Canabananalist.',
                'image' => 'banana.jpg',
            ],
            [
                'title' => 'Coconuts',
                'short_descr' => 'The best coconuts you will ever have.',
                'image' => 'coconut.jpg',
            ],
            [
                'title' => 'Mangos',
                'short_descr' => 'Because they\'re good for your heart.',
                'image' => 'mango.jpg',
            ],
            [
                'title' => 'Onions',
                'short_descr' => '**Don\'t get emotionally attached.**',
                'image' => 'onion.jpg',
            ],
            [
                'title' => 'Tomatos',
                'short_descr' => 'If it was long, skinny, and green, it would be a bean.',
                'image' => 'tomato.jpg',
            ],
        ];

        foreach( $t_products as $product ) {
            Product::factory(1)->create()->each(function($obj) use ($product) {
                $obj->title = $product['title'];
                $obj->short_descr= $product['short_descr'];
                $obj->image = $product['image'];
                $obj->save();
            });
        }
    }
}
