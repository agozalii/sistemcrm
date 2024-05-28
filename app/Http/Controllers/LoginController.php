<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {

            if (Auth::user()->role === 'member') {
                return redirect('/member/dashboard');
            }elseif (Auth::user()->role === 'manajer') {
                return redirect('/manajer/dashboard');
            } else {
                return redirect()->intended('home');
            }
            // if ($user->role == 'admin') {
            //     return redirect()->intended('homeadmin');
            // }elseif($user->role == 'manajer'){
            //     return redirect()->intended('homemanajer');
            // }

        }

        return view('login.view_login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
            ]
        );

        $kredensial = $request->only('username', 'password');

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // if ($user->role == 'admin') {
            //     return redirect()->intended('homeadmin');
            // }elseif($user->role == 'manajer'){
            //     return redirect()->intended('homemanajer');
            // }

            // if ($user) {
            //     return redirect()->intended('home');
            // }
            if ($user) {
                switch ($user->role) {
                    case 'admin':
                        return redirect()->intended('home');
                        break;
                    case 'kasir':
                        return redirect()->intended('home');
                        break;
                    case 'manajer':
                        return redirect('/manajer/dashboard');
                        break;
                    case 'member':
                        return redirect()->intended('/member/dashboard');
                        break;
                    default:
                        return redirect()->intended('/user/beranda');
                }
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Maaf username atau password salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
