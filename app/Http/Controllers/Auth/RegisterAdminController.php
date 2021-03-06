<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class RegisterAdminController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/auth/admin-login';

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
        return view('/auth/admin-register');
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

        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return redirect($this->redirectPath())->with('success', 'Registrierung erfolgreich!');;
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

        /*if ($validator->fails()){

            return back()->withErrors($validator);
        }*/

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'vorname' => $data['vorname'],
            'nachname' => $data['nachname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
