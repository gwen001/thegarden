<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $t_users = ['admin','gwen'];

        foreach( $t_users as $user ) {
            User::factory(1)->create()->each(function($obj) use ($user) {
                $obj->username = $user;
                $obj->save();
            });
        }

        \App\Models\User::factory(3)->create();
    }
}
