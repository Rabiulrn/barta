<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthManager extends Controller
{
    public function register()
    {
        return view("register");
    }
    public function login()
    {
        return view("login");
    }
    public function loginPost(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            // Authentication successful

            // You can perform additional actions here, such as redirecting the user
            return redirect()->intended(route('home')); // Redirect to the intended URL or a default dashboard route
        } else {
            // Authentication failed

            // You can return an error message or redirect back to the login page
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
        }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
    }
    public function registerPost(Request $request)
    {
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required| email",
            "password" => "required"
        ]);
        $validatedData = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')) // Hash the password before storing
        ];
        // dd($validatedData);
        DB::table('users')->insert($validatedData);

        return redirect()->route('login')->with('message', 'User registered successfully');
    }
}
