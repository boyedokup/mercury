<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Submission;
class InterestController extends Controller
{
    //

       public function index()
    {
    	$proposals=Submission::where('status','Saved')->where('type','proposal')->OrderBy('created_at','desc')->get();

    	$tenders=Submission::where('status','Saved')->where('type','tender')->OrderBy('created_at','desc')->get();

    	$quotations=Submission::where('status','Saved')->where('type','quotation')->OrderBy('created_at','desc')->get();

    	return view('interest.index',['proposals'=>$proposals,'quotations'=>$quotations,'tenders'=>$tenders,'countp'=>1,'countt'=>1,'countq'=>1]);
    }

    public function show ($user_id)
    {
      dd(Submission::all());

    }
}
