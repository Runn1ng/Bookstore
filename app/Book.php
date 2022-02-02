<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'book_id';
    public $timestamps = false;

    protected $fillable = ['title', 'author', 'pub_id', 'cat_id', 'pages', 'price', 'dat', 'image'];

    public function publisher(){
        return $this->belongsTo('App\Publisher', 'pub_id');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'cat_id');
    }
}
