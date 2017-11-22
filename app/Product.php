<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name','price','type','amount'
    ];

    public function cook(){
        return $this->belongsTo('App\Cook');
    }

}
