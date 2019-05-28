<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

     protected $fillable = [
        'id',
        'user_id',
        'car_id',
        'comment',
        // add all other fields
    ];
    protected $table = 'comments';

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function car() 
    {
        return $this->belongsTo('App\Car');
    }
}
