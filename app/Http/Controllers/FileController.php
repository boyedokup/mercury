<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\File;
use Input;
use Auth;
use Storage;



class FileController extends Controller
{
    //

    public function store(Request $request)
    {
      

  //       $this->validate($request,
		//     ['file' => 'mimes:pdf']
		// );


		if ( Input::file('file')->isValid()) 
    {

      $destinationPath = public_path('application_files'); // upload path
      $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension

       $fileName = Input::file('file')->getClientOriginalName(); // get full name +ext
         $just_name= explode(".", $fileName);

      $fileName = $just_name[0].'.'.$extension;

      //if(Storage::has('banners/'.$fileName))
      //Storage::delete('banners/'.$fileName);
      Input::file('file')->move($destinationPath, $fileName); // uploading file to given path

      $file= new File;
      $file->id= str_random(10);
      $file->reference_id= $request->reference_id;
      $file->url=$fileName;
      $file->user_id= Auth::user()->id;
      $file->save();
       

       }
    

	}



    public function index()
    {
    	return view('file.index');
    }


   public function destroy($id)
   {
      $file=File::find($id);
     
    if(Storage::has('application_files/'.$file->url))
      Storage::delete('application_files/'.$file->url);

    $file->delete();

    return $file;
   }


}
