<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = 'parents';

    protected $fillable = [
        'name','phone'
    ];

}
