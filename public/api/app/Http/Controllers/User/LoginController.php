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
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest:appuser')->except('logout');
    }

     /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $homeTitle = 'User Login';
        return view('user.login',array('homeTitle'=>$homeTitle));
    }
    
    /**
     * Login the doctor to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function login(Request $request){ 
       //validate the doctor login form
       $validation = Validator::make($request->all(), [            
            'email'     => 'required|email',
            'password'  => 'required|min:6',            
        ]);
        //
        
        if ($validation->fails()) { 
            return redirect()->back()->withErrors($validation)->withInput($request->only('email', 'remember'));   
        } 
        //
        $AppUser = AppUser::Where('email',$request->email)->first();
       
        if($AppUser){
            if (Hash::check($request->password, $AppUser->password)) {
                Auth::guard('appuser')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember);
                    
                return redirect()->intended(route('user.home'));
            }else{
                return redirect()->back()->withErrors(['Wrong password.'])->withInput($request->only('email', 'remember')); 
            }
        }else{
            return redirect()->back()->withErrors(['Email id does not exits.'])->withInput($request->only('email', 'remember')); 
        }
        

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
       
    }
    

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }
    
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('appuser');
    }
}
