<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cashout;
use App\User;
use App\Submission;
use Carbon\Carbon;
use App\CallForProposal;
use App\CallForQuotation;
use App\InvitationToTender;
use Auth;
use Mail;

class CashoutController extends Controller
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

       //do not touch this line---lol
       if($application->cashed_out !='')
         return redirect()->back()->with('fail','You have already cashed out');

     if($application->submission_closing_date > Carbon::now())
            return redirect()->back()->with('fail','You cannot cashout before Submission date');

    	return view ('cashout.show',['application'=>$application,'type'=>$type]);
    }

    public function store(Request $request)
    {

    	 $this->validate($request,[
            'bank' => 'required|max:255',
            'branch' => 'required|max:255',
            'account_name' => 'required|max:255',
            'account_no' => 'required|min:6|confirmed',
            'reference_id'=>'required|unique:cashout',
        ]);
    	
        

        $cashout= new Cashout;
        $id=str_random(10);
        $cashout->id=$id;
        $cashout->amount=$request->balance;
        $cashout->user_id=Auth::user()->id;
        $cashout->bank=$request->bank;
        $cashout->branch=$request->branch;
        $cashout->account_no=$request->account_no;
        $cashout->account_name=$request->account_name;
        $cashout->reference_id=$request->reference_id;
        $cashout->save();

        if($request->type=='proposal')
        {
           $proposal=CallForProposal::find($request->reference_id);
           $proposal->cashed_out=$id;
           $proposal->save();

           $application=$proposal;
         
        }
        

        if($request->type=='tender')
        {
           $tender=InvitationToTender::find($request->reference_id);
           $tender->cashed_out=$id;
           $tender->save();

           $application=$tender;
       #
        }
        

         if($request->type=='quotation')
        {
           $quotation=CallForQuotation::find($request->reference_id);
           $quotation->cashed_out=$id;
           $quotation->save();

           $application=$quotation;
           
        }


        $user=User::find(Auth::user()->id);
         Mail::send('auth.emails.cashout', ['user'=>$user,'balance'=>$request->balance,'bank'=>$request->bank,'branch'=>$request->branch,'account_name'=>$request->account_name,'account_number'=>$request->account_no,'type'=>$request->type,'reference_id'=>$request->reference_id,'application'=>$application], function ($m) use ($user) {

      $m->to($user->email,$user->name)->cc($user->company->email)->subject('Cashout');
     });
      
       return redirect('application')->with('success','Successful Request. Please check your email');

    }
}
