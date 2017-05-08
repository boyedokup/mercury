<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Company;
use App\User;
use App\Agency;
use App\Permission;

class AgencyController extends Controller
{
    //
  


public function store(Request $request)
{
     $this->validate($request, [
        'name' => 'required',
        'email' => 'required|unique:users',
         'contact'=>'required',
          'agency_name' => 'required',
         'agency_contact'=>'required'
    ]);
      
     
     $agency= new Agency;
     $agency->id= str_random(20);
     $agency->name= $request->agency_name;
     $agency->alias= $request->alias;
     $agency->contact= $request->agency_contact;
     $agency->save();

     $user= new User;
     $user->id= str_random(20);
     $user->agency_id=$agency->id;
     $user->name= $request->name;
     $user->email= $request->email;
     $user->contact= $request->contact;
     $user->status='Active';
     $user->role='Agency Admin';
     $user->password= bcrypt('Class1cals');

    
     $permission= new Permission;
     $permission->id = str_random(20);
     $permission->user_id= $user->id;
     $permission->can_create_user =1;
     $permission->can_edit_user =1;
     $permission->can_create_tender =1;
     $permission->can_edit_tender =1;
     $permission->can_publish_tender =1;
     $permission->can_reply_rfi=1;
     $permission->can_change_perm =1;
     $permission->can_add_criteria =1;
     $permission->can_add_reviewer =1;

      $permission->save();
       
      $user->permission_id= $permission->id;
      $user->save();

     return  redirect('agency')->with('success','Ministry/Agency create successfully.');
}



public function create()
{

	return view('agency.create');
}

public function index()
{
    $agencies= Agency::all();

    return view('agency.index',['agencies'=>$agencies]);
}

public function edit(Agency $agency)
{

 return view('agency.edit',['agency'=>$agency]);
}

public function update(Request $request,$id)
{

     $this->validate($request, [
        'name' => 'required',
         'contact'=>'required',
       ]);

   $agency= Agency::find($id);
   
     $agency->name= $request->name;
     $agency->alias= $request->alias;
     $agency->contact= $request->contact;
     $agency->save();


     return  redirect('agency')->with('success','Ministry/Agency updated successfully.');
}

}
