<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\CallForProposal;
use App\InvitationToTender;
use App\CallForQuotation;
use App\Category;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    //
    public function index()
    {    

    $proposal=CallForProposal::where('user_id',Auth::user()->id)->OrderBy('created_at','desc')->get();
	$tender=InvitationToTender::where('user_id',Auth::user()->id)->OrderBy('created_at','desc')->get();
	$quotation=CallForQuotation::where('user_id',Auth::user()->id)->OrderBy('created_at','desc')->get();
	$categories= Category::OrderBy('category.name','asc')->get();

    return view('application.index',['proposals'=>$proposal,'tenders'=>$tender,'quotations'=>$quotation,'categories'=>$categories,'countp'=>1,'countt'=>1,'countq'=>1]);
    }

    
}
