<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Permission;
use App\User;

class PermissionController extends Controller
{
    //

    public function show($id)
    {
      $perm= Permission::find($id);
      
      return view('permission.show',['permission'=>$perm]);

    }
   
}
