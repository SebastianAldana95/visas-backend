<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
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

    public $zones;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'identification' => ['required', 'string', 'max:12'],
            'phone' => ['required'],
            'zone_id' => ['required'],
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'identification' => $data['identification'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'zone_id' => $data['zone_id'],
            'role_id' => 2,
        ]);

        return $user;
    }

    protected function apiCreate(Request $request)
    {
        if ($request) {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'identification' => $request['identification'],
                'phone' => $request['phone'],
                'password' => Hash::make($request['password']),
                'zone_id' => $request['zone_id'],
                'role_id' => 2,
            ]);
            // $user->roles()->attach(Role::where('name', 'Consultor')->first());
            return response()->json([
                'success' => true,
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'data' => $request->toArray()
            ], 201);
        }
    }
}
