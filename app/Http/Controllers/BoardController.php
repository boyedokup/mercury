<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Company;
use App\User;
use App\Agency;

class BoardController extends Controller
{
    //
    public function index()
    {
        $agencies= Agency::all();

    	return view('board.index',['agencies'=>$agencies]);
    }


public function store(Request $request)
{
     $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
         'contact'=>'required'
    ]);

   

     $user= new User;
     $user->id= str_random(20);
     $user->name= $request->name;
     $user->email= $request->email;
     $user->contact= $request->contact;
     $user->status='Active';
     $user->role='Board';
     $user->password= bcrypt('Class1cals');

     $user->save();

     return  redirect('board')->with('success','Board Member create successfully.');
}

public function create()
{

	return view('board.create');
}

}
