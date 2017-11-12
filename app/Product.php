<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procuct extends Model
{

    protected $fillable = [
        'name','price','type','amount'
    ];

}
