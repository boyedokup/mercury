<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Criteria;
use Auth;

class CriteriaController extends Controller
{
    //



   public function show($tender_id)
  {
    //dd($tender_id);
    
  $criterias= Criteria::where('tender_id',$tender_id)->where('company_id',Auth::user()->company_id)->orWhere('agency_id',Auth::user()->agency_id)->get();
 
 return view('criteria.create',['criterias'=>$criterias,'tender_id'=>$tender_id]);
  }



    public function edit (Criteria $criteria)
    {
     
    	return view('criteria.edit',['criteria'=>$criteria]);
    }


    public function store(Request $request)
   {
    $this->validate($request, [
        'rubric' => 'required',
        
    ]);
   
   $criteria= new Criteria;
   $criteria->id= str_random(20);
   $criteria->user_id=Auth::user()->id;
   $criteria->company_id=Auth::user()->company_id;
   $criteria->agency_id=Auth::user()->agency_id;
   $criteria->tender_id=$request->tender_id;
   $criteria->rubric=$request->rubric;
   $criteria->weight= $request->weight;

   if($request->type=='on')
    $criteria->type='checkbox';
    else
    $criteria->type='textbox' ;
  
   $criteria->save();

   return redirect('view_tender_criteria/'.$request->tender_id)->with('success','Criteria created successfully');

    
  }

   public function update(Request $request,$id)
   {


    $this->validate($request, [
        'rubric' => 'required',

    ]);


   $criteria=Criteria::find($id);
   
   $criteria->weight=$request->weight;
   $criteria->rubric=$request->rubric;

   if($request->type=='on')
    $criteria->type='checkbox';
    else
    $criteria->type='textbox' ;
    
   $criteria->save();

    return redirect('view_tender_criteria/'.$id)->with('success','Criteria updated successfully');

    
  }
}
