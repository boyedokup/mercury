<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    //


    public $table='criteria';
    public $incrementing= false;
    public $primaryKey='id';

     public function owner()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
