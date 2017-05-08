<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Company;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;
use App\Permission;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'contact' => 'required|max:255',
            'company' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $id= str_random(20);
        $company = new Company;
        $company->id =$id;
        $company->company_registered_name=$data['company'];
        $company->verified='No';
        
        $company->save();
          
          $email=$data['email'];
          $name=$data['name'];
         Mail::send('auth.emails.signup', ['name'=>$name], function ($m) use ($email,$name) {

    $m->to($email,$name)->subject('Congratulations');
    });
      
      //set global user id
      $user_id= str_random(20);

     $permission= new Permission;
     $permission->id = str_random(20);
     $permission->user_id= $user_id;
     $permission->can_create_user =1;
     $permission->can_edit_user =1;
     $permission->can_create_tender =1;
     $permission->can_edit_tender =1;
     $permission->can_publish_tender =1;
     $permission->can_reply_rfi=1;
     $permission->can_change_perm =1;
     $permission->can_add_criteria =1;
     $permission->can_add_reviewer =1;
     $permission->can_submit_tender =1;
     $permission->can_review_tender =1;
     $permission->can_rfi =1;
     $permission->can_reply_rfi =1;
     $permission->can_view_submission =1;
     $permission->can_change_alert =1;
     $permission->can_save_favorites =1;
    
      $permission->save();


        return User::create([
            'id'=>$user_id,
            'company_id'=>$id,
            'name' => $data['name'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'role'=>'Company Admin',
            'status'=>'Active',
            'password' => bcrypt($data['password']),
            'permission_id'=>$permission->id,
        ]);
    }
}
