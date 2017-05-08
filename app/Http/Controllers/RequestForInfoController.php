<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\RequestForInfo;
use Auth;
use App\Submission;
use App\User;
use Mail;

class RequestForInfoController extends Controller
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
    	return view('rfi.show',['application'=>$application]);
    }

    public function store(Request $request)
    {
        
         $this->validate($request,[
            'message' => 'required|max:255',
            
        ]);

        $rfi= new RequestForInfo;
        $rfi->id=str_random(20);
        $rfi->status='request';
        $rfi->message=$request->message;
        $rfi->user_id=Auth::user()->id;
        $rfi->reference_id=$request->reference_id;
        $rfi->save();

          $app_owner=User::find($request->user_id);

          $user=User::find(Auth::user()->id);

          $message=$request->message;


        Mail::send('auth.emails.rfi_to_owner', ['app_owner'=>$app_owner,'id'=>$request->reference_id,'msg'=>$message], function ($m) use ($app_owner) {

       $m->to($app_owner->email,$app_owner->name)->cc($app_owner->company->email)->subject('Request For Info');
    	
    });

     Mail::send('auth.emails.rfi_to_user', ['user'=>$user,'msg'=>$message], function ($m) use ($user) {

       $m->to($user->email,$user->name)->cc($user->company->email)->subject('Request For Info');
    	
    });

    return redirect()->back()->with('success','Request sent to contractor');
}
}
