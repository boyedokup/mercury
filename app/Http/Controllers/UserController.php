<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Permission;
use Auth;

class UserController extends Controller
{
    //

   
    public function create()
   {
    
          return view('user.create');
    }


    public function edit (User $user)
    {

    	return view('user.profile',['user'=>$user]);
    }


    public function store(Request $request)
   {
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|unique:users',
         'contact'=>'required'
    ]);

   
     $user= new User;
     $user->id= str_random(20);
     $user->name= $request->name;
     $user->email= $request->email;
     $user->contact= $request->contact;
     $user->status='Active';
     $user->password= bcrypt('Class1cals');

     if(Auth::user()->company_id)
     {
      $user->role= 'Company User';
      $user->company_id= Auth::user()->company_id;
     }

     else 
     {
       # code...
      $user->role= 'Gov User';
      $user->agency_id= Auth::user()->agency_id;
     }

    
     
     $permission= new Permission;
     $permission->id = str_random(20);
     $permission->user_id= Auth::user()->id;
     $permission->save();
       
      $user->permission_id= $permission->id;
      $user->save();

    return  redirect('permission/'.$permission->id)->with('success','User create successfully. Kindly set the permission');

    
  }

   public function update(Request $request,$id)
   {

    $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'contact'=>'required'
    ]);


    $user= User::find($id);
    $user->name=$request->name;
    $user->contact=$request->contact;
    $user->email= $request->email;

    $user->save();

    return redirect()->back()->with('success','Profile updated successfully');

    
  }

  public function index ()

  {
    $users= User::where('company_id',Auth::user()->company_id)->orWhere('agency_id',Auth::user()->agency_id)->get();

    return view('user.index',['users'=>$users]);
  }
}
