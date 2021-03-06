<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = 'parents';

    protected $fillable = [
        'name','phone'
    ];

    public function request(){
        return $this->hasMany('App\Request','parent_id');
    }

    public function student(){
        return $this->hasMany('App\Student','parent_id');
    }

    public function user(){
        return $this->hasOne('App\User');
    }

}
