<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Company;
use Input;
use App\CompanyFile;
use Auth;
class CompanyController extends Controller
{
    //
    public function index()
    {
     return Company::all();
    }

    public function edit(Company $company)
    {
    	
        $files=CompanyFile::where('user_id',Auth::user()->id)->get();
    	return view('company.edit',['company'=>$company,'files'=>$files]);
    }

       public function update(Request $request,$id)
   {
   
    $this->validate($request, [
        'email' => 'required',
        'company_registered_name' => 'required',
        'contact'=>'required',
        'company_description'=>'required',
        'building_name'=>'required',
        'landmark'=>'required',
        'postal_address'=>'required',
        'city'=>'required',
        'area'=>'required',
        'country'=>'required',
        'country_of_registration'=>'required',
        'registration_ID'=>'required',
        'month_of_registration'=>'required',
        'year_of_registration'=>'required', 
        'tin'=>'required',
        'organizational_type'=>'required',
        'number_of_employees'=>'required',
        'share_gh_employees'=>'required',
        'share_gh_manager'=>'required',
        'share_gh_directors'=>'required',
        'has_local_content'=>'required',
        'gh_ownership_percentage'=>'required',
        'annual_turnover'=>'required',


    ]);


    $company=Company::find($id);
    $company->email=$request->email;
    $company->company_registered_name= $request->company_registered_name;
    $company->contact=$request->contact;
    $company->company_description=$request->company_description;
    $company->building_name=$request->building_name;
    $company->landmark=$request->landmark;
    $company->postal_address=$request->postal_address;
    $company->city=$request->city;
    $company->area=$request->area;
    $company->country=$request->country;
    $company->country_of_registration=$request->country_of_registration;
    $company->month_of_registration=$request->month_of_registration;
    $company->year_of_registration=$request->year_of_registration;
    $company->tin=$request->tin;
    $company->registration_ID=$request->registration_ID;
    $company->organizational_type=$request->organizational_type;
    $company->number_of_employees=$request->number_of_employees;
    $company->share_gh_employees=$request->share_gh_employees;
    $company->share_gh_manager=$request->share_gh_manager;
    $company->share_gh_directors=$request->share_gh_directors;
    $company->has_local_content=$request->has_local_content;
    $company->gh_ownership_percentage=$request->gh_ownership_percentage;
    $company->annual_turnover=$request->annual_turnover;
   

if ( isset($request->logo_url) && Input::file('logo_url')->isValid()) 
    {

      $destinationPath = public_path('company_logos'); // upload path
      $extension = Input::file('logo_url')->getClientOriginalExtension(); // getting image extension

       $fileName = Input::file('logo_url')->getClientOriginalName(); // get full name +ext
         $just_name= explode(".", $fileName);

      $fileName = $just_name[0]."-".str_random(10).'.'.$extension;

      //if(Storage::has('banners/'.$fileName))
      //Storage::delete('banners/'.$fileName);
      Input::file('logo_url')->move($destinationPath, $fileName); // uploading file to given path

      $company->logo_url= $fileName; 

       }

    $company->save();

    if($company->verified=='Yes')
    return redirect()->back()->with('success','Company profile updated successfully');
    else
    return redirect()->back()->with('success','Company profile updated successfully')->with('info','Your account will be verified soon.Please check your email');  

    
  }

  public function show($id)
  {

    $company= Company::find($id);
    return view('company.show',['company'=>$company]);
  }
}
