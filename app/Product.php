<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'image'
    ];
    public function attributes(){
        return $this->hasMany('App\ProductsAttribute', 'product_id');
    }
}
