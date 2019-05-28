<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
	protected $table = 'car_types';
     public function car()
    {
        return $this->hasMany('App\Car');
    }
}
