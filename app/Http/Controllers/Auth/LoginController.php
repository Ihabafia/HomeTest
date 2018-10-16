<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\{Email, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $this->validateLogin($request);

        $email = Email::checkUsername($request->email);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $email = Email::where(['email'=>$request->email, 'is_default'=>'1'])->first();
        if($email == null){
            return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
        }

        $user = User::find($email->user_id);
        $hash = Hash::make($request->password);

        if(Hash::check($request->password,$user->password)){
            // Login success
            Auth::loginUsingId($user->id);
            // Send the normal successful login response
            return $this->sendLoginResponse($request);
        }else{
            // Increment the failed login attempts and redirect back to the
            // login form with an error message.
            $this->incrementLoginAttempts($request);
            return redirect()
                ->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
