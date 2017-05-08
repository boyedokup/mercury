<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Review;
use Auth;
use App\Submission;
use App\Criteria;

class ReviewController extends Controller
{
    //

  public function show($id)

  {
      $tender= Submission::find($id);
      $tender_criterias= Criteria::where('tender_id',$tender->reference_id)->get();


  	return view('review.show',['tender_criterias'=>$tender_criterias,'tender'=>$tender,'submission_id'=>$id]);
  }

    public function store(Request $request)
    {

      
      //get al the criteria ids and loop through
    	$results= collect($request->criteria_id);


    	foreach ($results as $result) {
    		# code...

    	  $review = new Review;
    	  $review->id=str_random(20);
        $review->user_id =Auth::user()->id;
        $review->tender_id= $request->tender_id;
        $review->submission_id=$request->submission_id;
        $review->criteria_id=$result;

       
        $rate='rate_'.$result;
        $remark='remarks_'.$result;

        if($request->$rate=='on')
        $review->rate='100';
        else
        $review->rate=$request->$rate;

        $review->comment=$request->$remark;
       
        $review->save();  
        

        $submission= Submission::find($request->submission_id);

        //check if qualified
        $not_qualified= Review::where('submission_id',$request->submission_id)->where('rate',null)->first();
        if($not_qualified)
        $submission->selected='Not Qualified' ;
        else
         $submission->selected='Qualified' ;

        $submission->total_cost= $request->total_cost;
        $submission->save();
    	
    	}
   
        return redirect('submission/'.$request->tender_id)->with('success','Review submitted successfully');
    }


}
