<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashout extends Model
{
    //
    public $table='cashout';
    public $incrementing= false;
    public $primaryKey='id';

     public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
