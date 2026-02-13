<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login() {
        return view('auth.login');
    }

    function loginPost(Request $request) {
        $request->validate([ 
            "email" => "required|email",
            "password" => "required" 
        ]); 

        $credentials = $request->only("email", "password");

        if(Auth::attempt($credentials)) {
            //$request->session()->regenerate();
            return redirect()->intended(route("home"));
        } 
        return redirect(route("login"))->with( "error", "Invalid credentials" );
    }

    function logout(Request $request) {
        Auth::logout();
        //$request->session()->invalidate();
        //$request->session()->regenerateToken();
        return redirect(route("login"))->with("success", "Logged out successfully.");
    }


    function register() {
        return view('auth.register');
    }

    function registerPost(Request $request) 
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email', 
            'password' => 'required|min:6|confirmed'
        ]);
        $user = new User();
        $user->name = $request->name; 
        $user->email = $request->email; 
        $user->password = Hash::make($request->password); // Hash the password before saving
        if($user->save()){
            return redirect(route("login"))->with("success", "Account created successfully. Please login.");
        }
         return redirect(route("register"))->with("error", "Failed to create account. Please try again.");
    }
}
