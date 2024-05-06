<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
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
    // protected $redirectTo = '/home';
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/')->with('success', '<strong>Logout!</strong> Terima kasih sampai jumpa kembali.');
    }

    // fungsi login
    public function login(Request $request): RedirectResponse
    {
        $input = $request->all();

        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Email tidak valid!',
                'password.required' => 'Password tidak boleh kosong!',
            ]
        );

        $credentials = [
            'email' => $input['email'],
            'password' => $input['password'],
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.home')->with('success', 'Selamat datang <strong>' . Auth::user()->name . '</strong>');;
            } else {
                if (session()->has('url.intended')) {

                    return redirect(session()->get('url.intended'));
                } else {
                    return redirect()->route('home')->with('success', 'Selamat datang <strong>' . Auth::user()->name . '</strong>');
                }
            }
        } else {
            // Cek apakah email sudah terdaftar atau belum di database
            $user = User::where('email', $input['email'])->first();

            if ($user) {
                return redirect()->route('login')->with('error', 'Email atau password salah! Silahkan coba lagi.');
            } else {
                return redirect()->route('login')->with('error', 'Email tidak terdaftar! Silahkan daftar terlebih dahulu.');
            }
        }
    }
}
