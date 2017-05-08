<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallForQuotation extends Model
{
    //
    public $table='call_for_quotation';
    public $incrementing= false;
    public $primaryKey='id';

     public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

     protected $dates = ['created_at', 'updated_at', 'submission_closing_date'];
}
