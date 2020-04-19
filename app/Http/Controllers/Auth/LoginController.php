<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

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

    public function login(\Illuminate\Http\Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }else{
            $user = User::query()->where('email', request('email'))->first();
            if (!$user){

                $userCreate = [
                    'name' => request('email'),
                    'email' => request('email'),
                    'password' => bcrypt(request('password'))
                ];

                User::create($userCreate);

                if ($this->attemptLogin($request)) {
                    return $this->sendLoginResponse($request);
                }
            }
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        //轉導到Register
//        throw ValidationException::withMessages([
//            $this->username() => [trans('auth.failed')],
//        ])->redirectTo('/register');

        throw ValidationException::withMessages([
            'password' => [trans('passwords.failed')],
        ]);
    }
}
