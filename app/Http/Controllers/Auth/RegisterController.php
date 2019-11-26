<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UsersStatus;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'kode' => ['required', 'string', 'min:8', 'unique:users'],
            'warga_negara' => ['required'],
            'alamat' => ['required'],
            'provinsi' => ['required'],
            'kode_pos' => ['required', 'integer']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $stats0 = 'Admin Super';
        $stats1 = 'Admin Book';
        $stats2 = 'Admin CD';
        $stats3 = 'User';

        $id = strtotime('now');

        if(UsersStatus::count() == 0) {
           for ($i=0; $i < 4 ; $i++) { 
               UsersStatus::create([
                'status' => ${ 'stats'.$i },
               ]);
           }
        }

        $level = UsersStatus::where('status', 'User')->first();

        return User::create([
            'kode_anggota' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'level' => $level->id,
            'status' => 'active',
            'alamat' => $data['alamat'],
            'provinsi' => $data['provinsi'],
            'kode' => $data['kode'],
            'kode_pos' => $data['kode_pos'],
            'warga_negara' => $data['warga_negara'],
            'jenis_kelamin' => $data['jenis_kelamin'],
        ]);
    }
}
