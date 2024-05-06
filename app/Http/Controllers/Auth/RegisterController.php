<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
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
    // protected $redirectTo = '/home';
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
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'phone' => ['required', 'string', 'max:255', 'unique:users'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'phone' => $data['phone'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:users',
                'phone' => 'required|string|max:20|unique:users',
                'email' => 'required|string|email|max:50|unique:users',
                // 'password' => 'required|string|min:8|confirmed',
                'password' => 'required|string|min:8',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong!',
                'name.max' => 'Nama tidak boleh melebihi 255 karakter!',
                'phone.required' => 'Nomor telepon tidak boleh kosong!',
                'phone.max' => 'Nomor telepon tidak boleh melebihi 20 karakter!',
                'phone.unique' => 'Nomor telepon sudah terdaftar!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Email tidak valid!',
                'email.max' => 'Email tidak boleh melebihi 50 karakter!',
                'email.unique' => 'Email sudah terdaftar!',
                'password.required' => 'Password tidak boleh kosong!',
                'password.min' => 'Password minimal 8 karakter!',
                // 'password.confirmed' => 'Password dan Konfirmasi Password tidak cocok!',
            ]
        );


        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user->save()) {
            Auth::login($user);
            return redirect($this->redirectPath())->with('success', 'Pendaftaran akun anda berhasil, Selamat datang <strong>' . $user->name . '</strong> di SketchFood.');
        } else {
            return redirect($this->redirectPath())->with('error', 'Pendaftaran akun anda gagal, silahkan coba lagi.');
        }
    }
}
