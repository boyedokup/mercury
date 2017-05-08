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

class PublishController extends Controller
{
    //

    
     
     public function store(Request $request)
     {   
     	 $user=User::find(Auth::user()->id);

     	 if($user->company->verified=='No')
     	 	return redirect()->back()->with('fail','Your account has not been verified yet');

         if($request->application_type=='proposal')
         {
            $proposal=CallForProposal::find($request->reference_id);
            $proposal->status='Published';
            $proposal->category= implode(',',$request->setting);
            $proposal->save();

            $application=$proposal;
            $type='proposal';

         }
         if($request->application_type=='quotation')
         {
            $quotation=CallForQuotation::find($request->reference_id);
            $quotation->status='Published';
            $quotation->save();

             $application=$quotation;
             $type='quotation';

         }
         if($request->application_type=='tender')
         {
            $tender=InvitationToTender::find($request->reference_id);
            $tender->status='Published';
            $tender->save();
            
            $application=$tender;
            $type='tender';
         }

          $emails = DB::table('notification')
                  ->join('users', 'users.id', '=', 'notification.user_id')->select('users.email')->whereIn('category_id',$request->setting)->where('notification.status','true')->groupBy('users.email')->get();
         
          $user=Auth::user();
          
        Mail::send('auth.emails.publish', ['application'=>$application,'type'=>$type,'id'=>$request->reference_id,'user'=>$user], function ($m) use ($emails,$application) {
         
         foreach ($emails as $email) {
             $m->bcc($email->email);
                 }
         $m->subject('Notification: '.$application->name);

        });

     	return redirect()->back()->with('success','Application Published Successfully');
     }
    	
   
}
