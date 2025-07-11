<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login ()
    {
        return view ('auth.login');
    }

    function loginPost (Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|string|',
            'password' => 'required|min:7|string|'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }

        return redirect(route('login'))
            ->with('error', 'Invalid Email or Password');
    }

    function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    function register ()
    {
        return view('auth.register');
    }

    function registerPost(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email:rfc,dns|string|unique:users',
            'password' => 'required|min:7|string|'
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return redirect(route('login'))
                ->with('success', 'Registration Successfully');
        }

        return redirect(route('register'))
            ->with('error', 'Registration Failed');
    }
}
