<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::guard('customers')->attempt($credentials)) {

            $user = Auth::guard('customers')->user();
            $request->session()->put('user', $user); // Store user in session
            return redirect()->route('user.home')->with('success', 'logged in');
        } else {
            
            return redirect()->route('user.login')->with('error', 'Invalid credentials. Please try again.');
        }
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:6|max:10',
        ]);

        // Create new user
        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
        ]);


        if ($user) {


            return redirect()->route('user.login')->with('success', 'Registration successful. Please login.');
        } else {
            return redirect()->route('user.register')->with('error', 'Registration failed. Please try again.');
        }
    }
}
