<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->user_id,
                'username' => $user->username,
                'role' => $user->role,
                'full_name' => $user->full_name,
                'logged_in' => true,
            ]);

            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['login' => 'Username atau password salah.']);
        }

    }


    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}