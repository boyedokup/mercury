<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //


    public $table='review';
    public $incrementing= false;
    public $primaryKey='id';

     public function reviewer()
    {
        return $this->belongsTo('App\User','user_id');
    }

        public function criteria()
    {
        return $this->belongsTo('App\criteria','criteria_id');
    }
}
