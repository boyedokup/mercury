<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
public $table='notification';
    public $incrementing= false;
    public $primaryKey='id';

     public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

      public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

}
