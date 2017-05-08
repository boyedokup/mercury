<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvitationToTender extends Model
{
    //
    public $table='invitation_to_tender';
    public $incrementing= false;
    public $primaryKey='id';

     public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

     protected $dates = ['created_at', 'updated_at', 'submission_closing_date'];
}
