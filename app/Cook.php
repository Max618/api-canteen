<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cook extends Model
{
    protected $fillable = [
        'name'
    ];

    public function user(){
        return $this->hasOne('App\User');
    }

    public function product(){
        return $this->hasMany('App\Product');
    }
}
