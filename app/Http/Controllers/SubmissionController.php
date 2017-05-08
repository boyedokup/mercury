<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Submission;
use App\CallForProposal;
use App\CallForQuotation;
use App\InvitationToTender;
use Auth;
use PDF;

class SubmissionController extends Controller
{
    //

        public function index()
    {
    	$proposals=Submission::whereIn('status',['Submitted','Awarded'])->where('type','proposal')->where('user_id',Auth::user()->id)->OrderBy('created_at','desc')->get();

    	$tenders=Submission::whereIn('status',['Submitted','Awarded'])->where('type','tender')->where('user_id',Auth::user()->id)->OrderBy('created_at','desc')->get();

    	$quotations=Submission::whereIn('status',['Submitted','Awarded'])->where('type','quotation')->where('user_id',Auth::user()->id)->OrderBy('created_at','desc')->get();

    	return view('submission.index',['proposals'=>$proposals,'quotations'=>$quotations,'tenders'=>$tenders,'countp'=>1,'countt'=>1,'countq'=>1]);
    }

    public function show($id)
    {
        
        $submissions= Submission::where('reference_id',$id)->where('status','Submitted')->orWhere('status','Awarded')->OrderBy('selected','desc')->get();
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
        $count=0;
        return view('submission.show',['submissions'=>$submissions,'count'=>$count,'application'=>$application]);
    }

    public function submission_pdf_download($id)
    {
        
        $submissions= Submission::where('reference_id',$id)->where('status','Submitted')->OrderBy('selected','desc')->get();
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
        $count=0;

         $pdf = PDF::loadView('submission.pdf_download',['submissions'=>$submissions,'count'=>$count,'application'=>$application]);
         return $pdf->stream($id.'.pdf');
    }

}
