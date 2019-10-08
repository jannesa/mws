<?php

namespace App\Http\Controllers\Auth;

use App\Abo;
use App\User;
use App\UserModel as UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterUserController extends Controller
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/auth/user-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Show the application registration form.
     *
     * @return Response
     */
    protected function showRegistrationForm()
    {
        return view('/auth/register');
    }

    /**
     *
     * Override Trait RegistersUsers : vendor/laravel/framework/src/Illuminate/Foundation/Auth/RegistersUsers.php
     *
     */
    public function register(Request $request)
    {

        $validation = $this->validator($request->all());

        if ($validation->fails())  {

            return redirect()->back()->withInput()->withErrors($validation->errors());
        }


        $user = new UserModel();
        $user->vorname = $request->input('vorname');
        $user->nachname = $request->input('nachname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));


        switch ($request->input('abotype')) {
            case 'free':

                $user->abo_id = 1;

                break;

            case 'pro':

                $user->abo_id = 2;

                break;

            case 'premium':

                $user->abo_id = 3;

                break;
        }

        $user->save();


        return redirect('/auth/login/')->with('success', 'Registrierung erfolgreich!');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [

            'vorname.required' => 'Es wurde kein Vorname angegeben!',
            'nachname.required' => 'Es wurde keine Nachname angegeben!',
            'email.required' => 'Es wurde keine E-Mail angegeben!',
            'password.required' => 'Es wurde kein Passwort angegeben!',
            'email' => 'Das ist keine gültige E-Mail Adresse!',
            'vorname.max' => 'Der Vorname ist zu lang!',
            'nachname.max' => 'Der Nachname ist zu lang!',
            'password.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein!',
            'email.unique' => ' Diese E-Mail-Adresse wurde schon verwendet!',
            'password.confirmed'=> 'Die Passwörter stimmen nicht überein!',

            'vorname.string' => 'Der Vorname muss eine Zeichenkette sein!',
        ];

        return Validator::make($data, [
            'vorname' => ['required', 'string', 'max:25'],
            'nachname' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'vorname' => $data['vorname'],
            'nachname' => $data['nachname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
