<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CallForQuotation;
use App\File;
use Auth;
use App\Submission;

class CallForQuotationController extends Controller
{
    //

    public function create()
    {
    	return view('quotation.create');
    }

    public function edit(CallForQuotation $quotation)
    {
         $id=$quotation->id;
        $files=File::where('reference_id',$id)->where('user_id',Auth::user()->id)->get();

    	return view('quotation.edit',['quotation'=>$quotation,'files'=>$files]);
    }

     public function store (Request $request)

    {
    	//dd($request->all());
    	$this->validate($request,[
          'name'=>'required',
           'awarding_institution'=>'required',
           'scope_description'=>'required',
           'submission_closing_date'=>'required',
    		]);

    	$quotation= new CallForQuotation;
      $quotation->id =$request->id;
    	$quotation->name=$request->name;
    	$quotation->awarding_institution=$request->awarding_institution;
    	$quotation->contact=$request->contact;
    	$quotation->documents=$request->documents;
    	$quotation->scope_description=$request->scope_description;
    	$quotation->price=$request->price;
      $quotation->balance='0.00';
      $quotation->status='Pending';
    	$quotation->submission_closing_date=$request->submission_closing_date;
      $quotation->user_id=Auth::user()->id;
      $quotation->ministry= $request->ministry;
      $quotation->region= $request->region;
      $quotation->district= $request->district;
      $quotation->no_of_lots= $request->no_of_lots;

    	

    	$quotation->save();

    	return redirect('application')->with('success','Quotation created successfully')->with('info','Publish to enlist and send alerts');

    }

 public function update(Request $request,$id)

    {
        //dd($request->all());
        $this->validate($request,[
          'name'=>'required',
           'awarding_institution'=>'required',
           'scope_description'=>'required',
           'submission_closing_date'=>'required',
            ]);

        $quotation= CallForQuotation::find($id);
        $quotation->name=$request->name;
        $quotation->awarding_institution=$request->awarding_institution;
        $quotation->contact=$request->contact;
        $quotation->documents=$request->documents;
        $quotation->scope_description=$request->scope_description;
        $quotation->price=$request->price;
        $quotation->submission_closing_date=$request->submission_closing_date;
        $quotation->ministry=$request->ministry;
        $quotation->region=$request->region;
        $quotation->district=$request->district;
        $quotation->no_of_lots=$request->no_of_lots;
        

        $quotation->save();

        return redirect('application')->with('success','Quotation updated successfully');
    }
    public function show($id)
    {

        $quotation= CallForQuotation::find($id);
        $documents=$quotation->documents;
        $documents=explode(",", $documents);
        $files=File::where('reference_id',$id)->where('user_id',Auth::user()->id)->get();
        $quotation_owner=$quotation->user->id;
        $attachments=File::where('reference_id',$id)->where('user_id',$quotation_owner)->get();
        $submission= Submission::where('reference_id',$id)->where('user_id',Auth::user()->id)->first();
        
        return view('quotation.show',['quotation'=>$quotation,'files'=>$files,'documents'=>$documents,'attachments'=>$attachments,'submission'=>$submission]);
    }
}
