<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
            'first_name' => ['required', 'string', 'max:25', 'alpha_dash'],
            'middle_name' => ['nullable', 'alpha_dash', 'max:25'],
            'last_name' => ['required', 'string', 'max:25', 'alpha_dash'],
            'gender_id' => ['required'],
            'email' => ['required', 'string', 'email', 'unique:accounts'],
            'role_id' => ['required', 'between:0,1'],
            'password' => ['required', 'string', Password::min(8)->numbers()],
            'display_picture_link' => ['required', 'image', 'mimes:jpeg,jpg,png'],
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
        $account = Account::latest()->first();

        if($account)
        {
            $separate = explode('-', $account->account_id);
            $new_account = $separate[1] + 1;
            $new_account = "id-" . $new_account;
        }
        else
        {
            $new_account = "id-1";
        }

        $extension = request()->file('display_picture_link')->getClientOriginalExtension();
        $newfilename = time() . '.' . $extension;
        $path = request()->file('display_picture_link')->storeAs('public/images', $newfilename);

        return Account::create([
            'account_id' => $new_account,
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'gender_id' => $data['gender_id'],
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
            'display_picture_link' => $newfilename,
        ]);
    }
}
