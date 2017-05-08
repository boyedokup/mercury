<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CallForProposal;
use App\File;
use Auth;
use App\Submission;

class CallForProposalController extends Controller
{
    //

    public function create()
    {
    	return view('proposal.create');
    }

    public function edit ( CallForProposal $proposal)
    {  
        $id=$proposal->id;
        $files=File::where('reference_id',$id)->where('user_id',Auth::user()->id)->get();
    	return view('proposal.edit',['proposal'=>$proposal,'files'=>$files]);

    }
    

     public function update (Request $request,$id)

    {
        //dd($request->all());
        $this->validate($request,[
          'name'=>'required',
           'awarding_institution'=>'required',
           'agency'=>'required',
           'funding'=>'required',
           'scope_description'=>'required',
           'submission_closing_date'=>'required',
            ]);

        $proposal= CallForProposal::find($id);
        $proposal->name=$request->name;
        $proposal->awarding_institution=$request->awarding_institution;
        $proposal->agency=$request->agency;
        $proposal->funding=$request->funding;
        $proposal->contact=$request->contact;
        $proposal->scope_description=$request->scope_description;
        $proposal->price=$request->price;
        $proposal->submission_closing_date=$request->submission_closing_date;
        $proposal->documents= $request->documents;
        $proposal->ministry=$request->ministry;
        $proposal->region=$request->region;
        $proposal->district=$request->district;
        $proposal->no_of_lots=$request->no_of_lots;

        $proposal->save();

        return redirect('application')->with('success','Proposal updated successfully');

    }
    public function store (Request $request)

    {
    	//dd($request->all());
    	$this->validate($request,[
          'name'=>'required',
           'awarding_institution'=>'required',
           'agency'=>'required',
           'funding'=>'required',
           'scope_description'=>'required',
           'submission_closing_date'=>'required',
    		]);

    	$proposal= new CallForProposal;
        $proposal->id =$request->id;
    	$proposal->name=$request->name;
    	$proposal->awarding_institution=$request->awarding_institution;
    	$proposal->agency=$request->agency;
    	$proposal->funding=$request->funding;
    	$proposal->contact=$request->contact;
    	$proposal->scope_description=$request->scope_description;
    	$proposal->price=$request->price;
        $proposal->balance='0.00';
        $proposal->status='Pending';
    	$proposal->submission_closing_date=$request->submission_closing_date;
    	$proposal->documents= $request->documents;
        $proposal->user_id=Auth::user()->id;
        $proposal->ministry=$request->ministry;
        $proposal->region=$request->region;
        $proposal->district=$request->district;
        $proposal->no_of_lots=$request->no_of_lots;


    	$proposal->save();

    	return redirect('application')->with('success','Proposal created successfully')->with('info','Publish to enlist and send alerts');

    }

    public function show($id)
    {

        $proposal= CallForProposal::find($id);
        $documents=$proposal->documents;
        $documents=explode(",", $documents);
        $files=File::where('reference_id',$id)->where('user_id',Auth::user()->id)->get();
        $proposal_owner=$proposal->user->id;
        $attachments=File::where('reference_id',$id)->where('user_id',$proposal_owner)->get();
        $submission= Submission::where('reference_id',$id)->where('user_id',Auth::user()->id)->first();
        
        return view('proposal.show',['proposal'=>$proposal,'files'=>$files,'documents'=>$documents,'attachments'=>$attachments,'submission'=>$submission]);
    }

}
