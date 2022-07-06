<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'uniqid',
        'fullname',
        'address',
        'zipcode',
        'city',
        'country',
        'amount',
        'card_number',
        'card_expiration',
        'card_cvv',
        'cart',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'card_number',
        'card_expiration',
        'card_cvv',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'cart' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCardNumberAttribute($value)
    {
        return base64_decode($value);
    }

    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = base64_encode($value);
    }

    public function getCartAttribute($value)
    {
        return json_decode($value);
    }

    public function setCartAttribute($value)
    {
        $this->attributes['cart'] = json_encode($value);
    }

    public static function generateUniqid()
    {
        $letters = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        $l = strlen($letters)-1;
        $numbers = '123456789';
        $n = strlen($numbers)-1;
        $all = $letters.$numbers;
        $a = strlen($all)-1;

        return $letters[rand(0,$l)].$letters[rand(0,$l)].$numbers[rand(0,$n)].$numbers[rand(0,$n)].$all[rand(0,$a)].$all[rand(0,$a)].$all[rand(0,$a)].$all[rand(0,$a)];
    }
}
