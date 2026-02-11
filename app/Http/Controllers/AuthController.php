<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        if (session()->has('logged_in')) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // credential hardcoded
        if ($username === 'aldmic' && $password === '123abc123') {

            session([
                'logged_in' => true,
                'username'  => $username,
            ]);

            return redirect('/');
        }

        return back()->with('error', 'Incorrect username or password!');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
