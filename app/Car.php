<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'carname',
        'price',
        'type',
        'color',
        'brand',
        'year',
        // add all other fields
    ];
    // protected $upload = '/images/';
    protected $table = 'cars';

    public function brand() 
    {
        return $this->belongsTo('App\Brand');
    }

    public function color()
    {
        return $this->belongsTo('App\Color');
    }

    public function car_type()
    {
        return $this->belongsTo('App\CarType');
    }

     public function comment()
    {
        return $this->hasMany('App\Comment');
    }
}