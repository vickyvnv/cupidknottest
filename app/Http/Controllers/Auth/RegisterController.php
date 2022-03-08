<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'  => ['required'],
            'last_name' => ['required'],
            'dob' => ['required'],
            'gender' => ['required'],
            'annual_income' => ['required'],
            'occupation' => ['required'],
            'family_type' => ['required'],
            'mangalik' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Convert array to string
        $data['occupation'] = implode(",", $data['occupation']);
        $data['family_type'] = implode(",", $data['family_type']);

        return User::create([
            'is_admin' => 0,
            'first_name'  => $data['first_name'],
            'last_name'  => $data['last_name'],
            'dob'  => $data['dob'],
            'age' => Carbon::parse($data['dob'])->diff(Carbon::now())->y,
            'gender'  => $data['gender'],
            'annual_income'  => $data['annual_income'],
            'occupation'  => $data['occupation'],
            'family_type'  => $data['family_type'],
            'mangalik'  => $data['mangalik'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
