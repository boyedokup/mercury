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

class AcceptContractController extends Controller
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

       //change winner status
        $winner->status= 'Accepted Contract';
        $winner->save();


        //email to creater
          
        Mail::send('auth.emails.accept_contract_confirm_creater', ['tender'=>$tender,'type'=>$request->type,'winner'=>$winner], function ($m) use ($tender) {
         
              $m->to($tender->user->email);
             $m->cc($tender->user->company->email);
                
          $m->subject('Award Acceptance Confirmed');

        });


          //email to winner
         Mail::send('auth.emails.accept_contract_confirm_winner', ['tender'=>$tender,'type'=>$request->type,'id'=>$request->reference,'winner'=>$winner->user->company->company_registered_name], function ($m) use ($winner) {
         
            $m->to($winner->user->email);
             $m->cc($winner->user->company->email);
                 
          $m->subject('Congratulations for Accepting Award of Contract');

        });

     	return redirect()->back()->with('success','Contract Accepted Successfully');

        //email to awarder

     }
    	
   
}
