<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MainController extends Controller
{
    public function home()
    {
        $products = Product::take(3)->get();
        $data = compact('products');
        return view('user.home')->with($data);
    }

    public function shop(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $products = Product::whereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->orWhereHas('sub_category', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->get();
        } else {
            $products = Product::all();
        }


        $data = compact('products', 'search');
        return view('user.shop')->with($data);
    }

    public function login()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function logout(Request $request)
    {
        Auth::guard('customers')->logout();

        $request->session()->forget('user'); // Clear the user session data
        return redirect()->route('user.login')->with('success', 'successfully logged out');
    }

    public function checkout()
    {
        if (session()->has('user')) {
            return view('user.checkout');
        } else {
            return Redirect::route('user.login')->with('error', 'You need to log in to proceed with the checkout.');
        }
    }
}
