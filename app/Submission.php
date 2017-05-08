<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    //
     public $table='submissions';
    public $incrementing= false;
    public $primaryKey='id';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Company','company_id');
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
