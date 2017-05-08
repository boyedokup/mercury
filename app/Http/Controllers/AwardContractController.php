<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CallForProposal;
use App\CallForQuotation;
use App\InvitationToTender;
use App\User;
use Auth;
use Mail;
use App\Nofication;
use DB;
use App\Submission;

class AwardContractController extends Controller
{
    //

    
     
     public function store(Request $request)

     {   

       $applicants=Submission::where('reference_id',$request->reference)->where('payment_status','Paid')->get();
       $winner=Submission::find($request->id);

       if($request->type=='tender')
       $tender= InvitationToTender::find($request->reference);

        if($request->type=='proposal')
       $tender= CallForProposal::find($request->reference);

       if($request->type=='quotation')
       $tender= CallForQuotation::find($request->reference);

          //change winner status to awarded;
        $winner->status= 'Awarded';
        $winner->save();

         //updated tender as awarded

        $tender->status ='Awarded';
        $tender->save();

        //email to paid applicants
          
        Mail::send('auth.emails.contract_award', ['tender'=>$tender,'type'=>$request->type,'id'=>$request->reference,'winner'=>$winner->user->company->company_registered_name], function ($m) use ($applicants) {
         
         foreach ($applicants as $applicant) {
             $m->bcc($applicant->user->email);
                 }
          $m->subject('Contract Award');

        });


          //email to winner
         Mail::send('auth.emails.accept_contract', ['tender'=>$tender,'type'=>$request->type,'id'=>$request->reference,'winner'=>$winner->user->company->company_registered_name], function ($m) use ($winner) {
         
            $m->to($winner->user->email);
             $m->cc($winner->user->company->email);
                 
          $m->subject('Congratulations for Award of Contract');

        });

     	return redirect()->back()->with('success','Contract Awarded Successfully');

        //email to awarder

     }
    	
   
}
