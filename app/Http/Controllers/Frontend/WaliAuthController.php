<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WaliAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:100',

            'email' => 'required|email|unique:users,email',

            'phone' => 'required|max:20',

            'password' => 'required|min:8|confirmed'

        ]);

        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'password' => Hash::make($request->password),

            'role' => 'wali'

        ]);

        return redirect()
            ->route('wali.login')
            ->with(
                'success',
                'Akun berhasil dibuat, silakan login.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('frontend.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([

            'email' => 'required|email',

            'password' => 'required'

        ]);

        $credentials['role'] = 'wali';

        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            return redirect()
                ->route('wali.home');

        }

        return back()->with(

            'error',

            'Email atau password salah.'

        );

    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}