<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use App\Company;
use Auth;
use App\User;
use App\Category;
use DB;
class NotificationController extends Controller
{
    //

    public function index()
    {
      $category = DB::table('category')
                  ->leftJoin('notification', 'category.id', '=', 'notification.category_id')->select('category.id','notification.status','category.name','notification.user_id')->OrderBy('category.name','asc')->get();
     
      return view('notification.create',['categories'=>$category]);
    }

    public function store(Request $request)
    {
        $data=Input::get('check');

        $user =User::find(Auth::user()->id);
        $user->notification_category=$data;
        $user->save();
    	return $data;
    }


}
