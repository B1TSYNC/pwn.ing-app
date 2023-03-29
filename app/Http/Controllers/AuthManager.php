<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        
        return view('login');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        
        return view('register');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Please enter your username',
            'password.required' => 'Please enter your password'
        ]);

        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        
        return redirect(route('login'))->with("error", "Login credentials invalid");
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|alpha_num',
            'email' => 'required|email|unique:users|regex:/^.+@.+\..+$/i',
            'password' => 'required'
        ], [
            'username.required' => 'Username is required',
            'username.unique' => 'Username taken, please pick another one',
            'email.required' => 'Email is required, we recommend using a privacy-focused Email service',
            'email.email' => 'Please enter a valid Email',
            'email.unique' => 'This email address is already registered. Please use another one or log in with your existing account',
            'email.regex' => 'Please enter a valid email address for account verification and communication',
            'password.required' => 'Password is required to secure your account'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if (!$user) {
            return redirect(route('register'))->with("error", "Registration failed, please try again");
        }
        
        return redirect(route('login'))->with("success", "Successfully registered account named ".$request->username);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        
        return redirect(route('login'));
    }

    public function cli()
    {
        if (Auth::check()) {
            return view('cli');
        } 
        
        return redirect('/login');
    }
}
