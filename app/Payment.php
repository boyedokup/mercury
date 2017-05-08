<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //


    public $table='payment';
    public $incrementing= false;
    public $primaryKey='id';

     public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
