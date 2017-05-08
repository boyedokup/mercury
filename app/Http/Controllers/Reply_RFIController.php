<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Submission;
use App\RequestForInfo;
use Auth;
use App\User;
use Mail;

class Reply_RFIController extends Controller
{
    //

    public function show($id)
    {
      $application=Submission::where('reference_id',$id)->first();
        if($application->type=='proposal')
        {
            $application=$application->proposal;
            $type='proposal';
        }

        if($application->type=='tender')
        {
            $application=$application->tender;
            $type='tender';
        }

        if($application->type=='quotation')
        {
          $application=$application->quotation;
          $type='quotation';
        }

       $requests= RequestForInfo::where('reference_id',$id)->OrderBy('created_at','desc')->get();

    	return view('rfi.reply',['application'=>$application,'requests'=>$requests]);
    }

    public function store(Request $request)
    {
    	 $this->validate($request,[
            'message' => 'required|max:255',
            
        ]);
      
      $reply=RequestForInfo::find($request->id);
      $reply->status='reply';
      $reply->save();
      
      $emails=Submission::where('reference_id',$request->reference_id)->where('payment_status','Paid')->get();
  
      $user=User::find(Auth::user()->id);

       Mail::send('auth.emails.reply_to_rfi', ['user'=>$user,'msg'=>$request->message,'question'=>$reply->message], function ($m) use ($emails) {
         foreach ($emails as $email) {
         $m->bcc($email->user->email);
         }

       $m->subject('Reply To RFI');
    	
    });
    	return redirect()->back()->with('success','Reply successfully sent to clients');
    }
}
