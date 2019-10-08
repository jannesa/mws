<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Traits\AuthenticateUser;
use App\Http\Controllers\Controller;

class LoginUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Business User Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticateUser;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/events';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }


}
