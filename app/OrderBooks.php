<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderBooks extends Model
{
    protected $table = 'order_books';
    public $timestamps = false;

    protected $fillable = ['order_id', 'book_id', 'count', ];

}
