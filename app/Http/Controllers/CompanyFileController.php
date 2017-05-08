<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CompanyFile;
use Input;
use Auth;
class CompanyFileController extends Controller
{
    //
     public function store(Request $request)
    {
      

		if ( Input::file('file')->isValid()) 
    {

      $destinationPath = public_path('company_files'); // upload path
      $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension

       $fileName = Input::file('file')->getClientOriginalName(); // get full name +ext
         $just_name= explode(".", $fileName);

      $fileName = $just_name[0]."-".str_random(10).'.'.$extension;

      //if(Storage::has('banners/'.$fileName))
      //Storage::delete('banners/'.$fileName);
      Input::file('file')->move($destinationPath, $fileName); // uploading file to given path

      $file= new CompanyFile;
      $file->id= str_random(10);
      $file->url=$fileName;
      $file->user_id= Auth::user()->id;
      $file->save();
       
       }

       }
}
