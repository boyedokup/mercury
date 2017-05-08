<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\InvitationToTender;
use App\File;
use Auth;
use App\Submission;

class InvitationToTenderController extends Controller
{
    //
    public function create()
    {
    	return view('tender.create');
    }

   
   public function edit(InvitationToTender $tender)
    {
       $id=$tender->id;
        $files=File::where('reference_id',$id)->where('user_id',Auth::user()->id)->get();
    	return view('tender.edit',['tender'=>$tender,'files'=>$files]);
    }


  public function store (Request $request)

    {
    	//dd($request->all());
    	$this->validate($request,[
          'name'=>'required',
           'awarding_institution'=>'required',
           'category_of_contractor'=>'required',
           'agency'=>'required',
           'funding'=>'required',
           'scope_description'=>'required',
           'submission_closing_date'=>'required',
    		]);

    	$tender= new InvitationToTender;
      $tender->id =$request->id;
    	$tender->name=$request->name;
    	$tender->awarding_institution=$request->awarding_institution;
    	$tender->agency=$request->agency;
    	$tender->category_of_contractor=$request->category_of_contractor;
    	$tender->funding=$request->funding;
    	$tender->documents=$request->documents;
    	$tender->contact=$request->contact;
    	$tender->scope_description=$request->scope_description;
    	$tender->price=$request->price;
      $tender->balance='0.00';
      $tender->status='Pending';
    	$tender->submission_closing_date=$request->submission_closing_date;
      $tender->user_id=Auth::user()->id;
      $tender->ministry=$request->ministry;
      $tender->region=$request->region;
      $tender->district=$request->district;
      $tender->no_of_lots=$request->no_of_lots;
    	

    	$tender->save();

    	return redirect('application')->with('success','Tender created successfully')->with('info','Publish to enlist and send alerts');

    }

    public function update (Request $request,$id)

    {
      //dd($request->all());
      $this->validate($request,[
          'name'=>'required',
           'awarding_institution'=>'required',
           'category_of_contractor'=>'required',
           'agency'=>'required',
           'funding'=>'required',
           'scope_description'=>'required',
           'submission_closing_date'=>'required',
        ]);

      $tender= InvitationToTender::find($id);
      $tender->name=$request->name;
      $tender->awarding_institution=$request->awarding_institution;
      $tender->agency=$request->agency;
      $tender->category_of_contractor=$request->category_of_contractor;
      $tender->funding=$request->funding;
      $tender->documents=$request->documents;
      $tender->contact=$request->contact;
      $tender->scope_description=$request->scope_description;
      $tender->price=$request->price;
      $tender->submission_closing_date=$request->submission_closing_date;
      $tender->ministry=$request->ministry;
      $tender->region=$request->region;
      $tender->district=$request->district;
      $tender->no_of_lots=$request->no_of_lots;
      
      

      $tender->save();

      return redirect('application')->with('success','Tender updated successfully');

    }

    public function show($id)
    {

        $tender= InvitationToTender::find($id);
        $documents=$tender->documents;
        $documents=explode(",", $documents);
        $files=File::where('reference_id',$id)->where('user_id',Auth::user()->id)->get();
        $tender_owner=$tender->user->id;
        $attachments=File::where('reference_id',$id)->where('user_id',$tender_owner)->get();
        $submission= Submission::where('reference_id',$id)->where('user_id',Auth::user()->id)->first();
        
        return view('tender.show',['tender'=>$tender,'files'=>$files,'documents'=>$documents,'attachments'=>$attachments,'submission'=>$submission]);
    }

}
