<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderBasket extends Model
{
    protected $table = 'basket_books';
    public $timestamps = false;

    protected $fillable = ['customer_id', 'book_id', 'count'];

}
