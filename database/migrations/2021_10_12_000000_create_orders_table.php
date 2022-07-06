<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid','8')->unique();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 9, 2);
            $table->string('fullname',64);
            $table->string('address');
            $table->string('zipcode',16);
            $table->string('city',64);
            $table->string('country',64);
            $table->text('card_number');
            $table->string('card_expiration',5);
            $table->string('card_cvv',3);
            $table->text('cart');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
