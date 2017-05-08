<?php
MPower_Setup::setMasterKey("ac37e449-0ec4-45fc-8cc5-955e88d44b34");
MPower_Setup::setPublicKey("test_public_Kq8TJ-L39u4YnctUA0cg6KGHw7Y");
MPower_Setup::setPrivateKey("test_private_JtQvyxxetKxuJOVpxLemhSzhUpw");
MPower_Setup::setMode("test");
MPower_Setup::setToken("f632ae60dc9154642aa3");

//Setup your Store information
MPower_Checkout_Store::setName("TenderBox");
MPower_Checkout_Store::setTagline("E-tendering solution");
MPower_Checkout_Store::setPhoneNumber("+233.....");
MPower_Checkout_Store::setPostalAddress("Post office Box NG 78,Ghana");
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

	$proposal=App\CallForProposal::where('submission_closing_date','>=',Carbon\Carbon::now())->where('status','Published')->OrderBy('created_at','desc')->get();
	$tender=App\InvitationToTender::where('submission_closing_date','>=',Carbon\Carbon::now())->where('status','Published')->OrderBy('created_at','desc')->get();
	$quotation=App\CallForQuotation::where('submission_closing_date','>=',Carbon\Carbon::now())->where('status','Published')->OrderBy('created_at','desc')->get();

    return view('welcome',['proposals'=>$proposal,'tenders'=>$tender,'quotations'=>$quotation,'countp'=>1,'countt'=>1,'countq'=>1]);
});

Route::auth();

Route::get('/home', function () {
   
   return redirect ('/');
});
Route::get('/about', function () {
   
   return view('about');
});

Route::group(['middleware' => ['auth']], function () {
    //
Route::resource('user','UserController');
Route::resource('permission','PermissionController');
Route::resource('proposal','CallForProposalController');
Route::resource('tender','InvitationToTenderController');
Route::resource('quotation','CallForQuotationController');
Route::resource('company','CompanyController');
Route::resource('file','FileController');
Route::resource('payment','PaymentController');
Route::resource('submission','SubmissionController');
Route::get('submission_pdf_download/{id}','SubmissionController@submission_pdf_download');
Route::resource('notification','NotificationController');
Route::resource('interest','InterestController');
Route::resource('application','ApplicationController');
Route::resource('category','CategoryController');
Route::resource('publish','PublishController');
Route::resource('company_file','CompanyFileController');
Route::resource('ad','AdController');
Route::resource('cashout','CashoutController');
Route::resource('request_for_info','RequestForInfoController');
Route::resource('reply_rfi','Reply_RFIController');
Route::resource('award_contract','AwardContractController');
Route::resource('accept_contract','AcceptContractController');
Route::resource('review','ReviewController');
Route::resource('criteria','CriteriaController');
Route::resource('board','BoardController');
Route::resource('agency','AgencyController');

//view all criteria for tender for an application
Route::get('view_tender_criteria/{tender_id}', function ($tender_id) {
   
  $criterias= App\Criteria::where('tender_id',$tender_id)->where('company_id',Auth::user()->company_id)->orWhere('agency_id',Auth::user()->agency_id)->get();
 
 return view('criteria.show',['criterias'=>$criterias,'tender_id'=>$tender_id]);
});

//view review summary for a submission
Route::get('review_summary/{submission_id}', function ($submission_id) {
   
  $reviews= App\Review::where('submission_id',$submission_id)->get();
  $submission=App\Submission::find($submission_id);

  return view('review.summary',['reviews'=>$reviews,'submission'=>$submission]);
});

});


/*
 This functions saves applications users are interested in so they can apply later
*/
Route::get('save_application/{application}/{type}', function ($application_id,$type) 
{
	$check= App\Submission::where('user_id',Auth::user()->id)->where('reference_id',$application_id)->first();
	if($check)
	return redirect()->back()->with('fail','You have saved this application already');
   else
   {
	$interest=new  App\Submission;
	$interest->id= str_random(20) ;
	$interest->user_id=Auth::user()->id;
	$interest->reference_id=$application_id;
	$interest->status= 'Saved';
	$interest->type=$type;
	$interest->save();

	return redirect()->back()->with('success','Application Saved Successfully');
   }

});

Route::get('submit_later/{application}/{type}', function ($application_id,$type) 
{
	$check= App\Submission::where('user_id',Auth::user()->id)->where('reference_id',$application_id)->first();
	if($check)
	return redirect()->back()->with('info','Check Interests for application');
   else
   {
	$interest=new  App\Submission;
	$interest->id= str_random(20) ;
	$interest->user_id=Auth::user()->id;
	$interest->reference_id=$application_id;
	$interest->status= 'Saved';
	$interest->type=$type;
	$interest->save();

	return redirect()->back()->with('success','Application Saved Successfully.')->with('info','Check Interests for application');
   }

});


Route::get('submit_now/{application}/{type}', function ($application_id,$type) 
{

	$user=App\User::find(Auth::user()->id);

	 if($user->company->verified=='No')
	 return redirect()->back()->with('fail','Your account has not been verified yet');

	$check= App\Submission::where('user_id',Auth::user()->id)->where('reference_id',$application_id)->first();
	if($check)
	{
	$check->status='Submitted';
	$check->save();

    }
   else
   {
	$interest=new  App\Submission;
	$interest->id= str_random(20) ;
	$interest->user_id=Auth::user()->id;
	$interest->reference_id=$application_id;
	$interest->status= 'Submitted';
	$interest->type=$type;
	$interest->save();

	
   }

 $application=App\Submission::where('reference_id',$application_id)->first();

if($type=='proposal')
$application=$application->proposal;

if($type=='quotation')
$application=$application->quotation;

if($type=='tender')
$application=$application->tender;

   $user=App\User::find(Auth::user()->id);

 Mail::send('auth.emails.submission', ['user'=>$user,'application'=>$application], function ($m) use ($user,$application) {

    $m->to($user->email,$user->name)->subject('Successful Submission-'.$application->name)->cc($user->company->email);
});

   return redirect('submission')->with('success','Application has been submitted Successfully.');

});

Route::get('set_notification/{id}/{status}', function ($id,$status) 
{
	
	$notification=App\Notification::where('user_id',Auth::user()->id)->where('category_id',$id)->first();
   
	if($notification)
	$notification->delete();

	$notification= new App\Notification;
	$notification->id= str_random(10);
	$notification->user_id=Auth::user()->id;
	$notification->status=$status;
	$notification->category_id=$id;
	$notification->save();

	return 'done';
   

});

Route::get('set_selection/{id}/{status}', function ($id,$status) 
{
	
	$submission=App\Submission::find($id);
  
	$submission->selected=$status;
	$submission->save();

	return 'done';
   

});


Route::get('get_files/{user_id}/{app_id}', function ($user_id,$app_id) 
{
	
	$files=App\File::where('reference_id',$app_id)->where('user_id',$user_id)->get();

	return $files;
   

});

Route::get('payment_callback/{application}/{type}', function ($application_id,$type) 
{

	// param $_GET['token'] if not explicitly specified
    $token = $_GET["token"];

$invoice = new MPower_Checkout_Invoice();
if ($invoice->confirm($token)) {

 // Retrieving Invoice Status
 // Status can be either completed, pending, canceled, fail
 if($invoice->getStatus()=='completed')
{

	$check= App\Submission::where('user_id',Auth::user()->id)->where('reference_id',$application_id)->first();
	if($check)
	{
	$check->status='Saved';
	$check->payment_status='Paid';
	$check->save();

    }
   else
   {
	$interest=new  App\Submission;
	$interest->id= str_random(20) ;
	$interest->user_id=Auth::user()->id;
	$interest->reference_id=$application_id;
	$interest->status= 'Saved';
	$interest->payment_status='Paid';
	$interest->type=$type;
	$interest->save();

	
   }

$payment=new App\Payment;
$payment->id=str_random(20);
$payment->token=$token;
$payment->reference_id=$application_id;
$payment->user_id=Auth::user()->id;
$payment->amount=$invoice->getTotalAmount();
$payment->save();

if($type=='proposal')
{
	$proposal=App\CallForProposal::find($application_id);
	$proposal->increment('balance',$invoice->getTotalAmount());
}

if($type=='tender')
{
	$tender=App\InvitationToTender::find($application_id);
	$tender->increment('balance',$invoice->getTotalAmount());
}
if($type=='quotation')
{
	$quotation=App\CallForQuotation::find($application_id);
	$quotation->increment('balance',$invoice->getTotalAmount());
}

   // Return the URL to the Invoice Receipt PDF file for download
 $receipt=$invoice->getReceiptUrl();
 $amount=$invoice->getTotalAmount();
 $application=App\Submission::where('reference_id',$application_id)->first();

if($type=='proposal')
$application=$application->proposal;

if($type=='quotation')
$application=$application->quotation;

if($type=='tender')
$application=$application->tender;

$user=App\User::find(Auth::user()->id);

 Mail::send('auth.emails.payment', ['receipt' => $receipt,'user'=>$user,'amount'=>$amount,'application'=>$application], function ($m) use ($user,$application) {

    $m->to($user->email,$user->name)->subject('Successful Payment-'.$application->name)->cc($user->company->email);
});

   if($type=='proposal')
   return redirect('proposal/'.$application_id)->with('success','Payment Successful')->with('info','Check email for any payment receipt.Application has been added to your interests');
   if($type=='quotation')
   return redirect('quotation/'.$application_id)->with('success','Payment Successful')->with('info','Check email for any payment receipt.Application has been added to your interests');
 if($type=='tender')
   return redirect('tender/'.$application_id)->with('success','Payment Successful')->with('info','Check email for any payment receipt.Application has been added to your interests');

}
}
});



    Route::get('pay_for_tender/{amount}/{application_id}/{type}', function ($amount,$application_id,$type)
      {
           
           $user=App\User::find(Auth::user()->id);

			 if($user->company->verified=='No')
			 return redirect()->back()->with('fail','Your account has not been verified yet');

            // If you intend to use a simpler approach by redirecting to the MPower checkout page
            $invoice = new MPower_Checkout_Invoice();
            $invoice->setTotalAmount($amount);

            // Custom data allows you to add extra data to the invoice information
            // which can be accessed via our confirm API callback

            $invoice->addCustomData("application_id",$application_id);
            $invoice->addCustomData("amount",$amount);
            $invoice->addCustomData("type",$type);
            
            $application_name=App\Submission::where('reference_id',$application_id)->first();

              if($type=='proposal')
             $invoice->setDescription("Payment of GHS ".$amount.' to '.$application_name->proposal->name);
              
              if($type=='quotation')
             $invoice->setDescription("Payment of GHS ".$amount.' to '.$application_name->quotation->name);

             if($type=='tender')
             $invoice->setDescription("Payment of GHS ".$amount.' to '.$application_name->tender->name);


            // Setting the cancel URL on an invoice instance.
          // This will overwrite any global settings for cancel URL
         $invoice->setCancelUrl(URL::previous());

         // Setting the return URL on an invoice instance.
        // This will overwrite any global settings for return URL
        $invoice->setReturnUrl(url('payment_callback/'.$application_id.'/'.$type));

           // The code below depicts how to create the checkout invoice on our servers
            // and redirect to the checkout page.
            if($invoice->create()) {

              return redirect($invoice->getInvoiceUrl());
            }else{
              return redirect()->back()->with('fail',$invoice->response_text);
            }


      });
