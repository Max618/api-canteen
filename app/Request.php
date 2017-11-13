<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    protected $fillable = [
        'type','f_price','list','delivered'
    ];

    public function parent(){
        return $this->belongsTo('App\Responsable');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

}
