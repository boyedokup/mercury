<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForInfo extends Model
{
    //
     public $table='request_for_info';
    public $incrementing= false;
    public $primaryKey='id';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function proposal()
    {
        return $this->belongsTo('App\CallForProposal','reference_id');
    }
    public function tender()
    {
        return $this->belongsTo('App\InvitationToTender','reference_id');
    }
    public function quotation()
    {
        return $this->belongsTo('App\CallForQuotation','reference_id');
    }
   
}
