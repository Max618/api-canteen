<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name','class'
    ];

    public function request(){
        return $this->hasMany('App\Request');
    }

    public function parent(){
        return $this->belengsTo('App\Responsable');
    }
}
