<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Crypt;
use Hash;
use Session;
use carbon\Carbon;
use App\Model\AppUser;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:appuser');
    }

   
     /**
         * Show the application's login form.
         *
         * @return \Illuminate\Http\Response
         */
        public function showRegisterForm()
        {
            $homeTitle = 'User Registration';
            return view('user.register',array('homeTitle'=>$homeTitle));
        }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request)
    {
        $validation = Validator::make($request->all(), [            
           'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:dd_app_users',
            'password' => 'required|string|min:6|confirmed', 
        ]);
        //
        
        if ($validation->fails()) { 
            return redirect()->back()->withErrors($validation)->withInput($request->only('email', 'username'));   
        }
       AppUser::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->intended(route('thankyou'));
    }
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function Thankyou()
    {
        $homeTitle = 'Registration successfull';
        return view('thank-you',array('homeTitle'=>$homeTitle));
    }
}
