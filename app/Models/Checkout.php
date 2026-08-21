<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['user_id','payment_method', 'total_book','total_book_price', 'total_price','status'])]
class Checkout extends Model
{
    //
}
