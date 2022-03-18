<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
                'username' => $request->{$this->username()},
                'password' => $request->password, 
                'status' => 1
               ];
    //     $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL) ? $this->username() : 'username';

    //     return [
    //         $field => $request->get($this->username()),
    //         'password' => $request->password,
    //     ];
    }


   protected function authenticated(Request $request, $user)
    {

      if(Auth::check()){

        SystemLogs::saveLogs(Auth::user()->username.' account has logged in!');

       if(Auth::user()->first_login == 0){
            
            $request->session()->flash('msg','As a security measure, you need to update your password.');
            return redirect('manage-accounts/first-login');
        }
     }

       
    }
   
}