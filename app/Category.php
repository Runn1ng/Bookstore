<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'cat_id';
    public $timestamps = false;

    protected $fillable = ['name'];
}
