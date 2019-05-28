<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function car()
    {
        $this->hasMany('App\Car');
    }
}
