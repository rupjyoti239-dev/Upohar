<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity');
        $cart = session()->get('cart', []);

        if (Auth::guard('customers')->check()) {
            $user = Auth::guard('customers')->user();
            $existingCartItem = Cart::where('customer_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCartItem) {
                // If the cart item already exists, update the quantity
                $existingCartItem->update([
                    'quantity' => $existingCartItem->quantity + $quantity,
                ]);
            } else {
                // If the cart item doesn't exist, create a new cart item
                Cart::create([
                    'customer_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                ]);
            }
        } else {
            // If user is not logged in, handle the cart in session
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'image' => $product->image,
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }



    public function index()
    {
        if (Auth::guard('customers')->check()) {
            $customer = Auth::guard('customers')->user();
            $cart = Cart::where('customer_id', $customer->id)->get();
        } else {
            $cart = session()->get('cart', []);
        }

        return view('user.cart', compact('cart'));
    }




    public function remove($id)
    {
        // dd(Auth::guard('customers')->check());
        if (Auth::guard('customers')->check()) {
            $customer = Auth::guard('customers')->user();
            $cartItem = Cart::where('customer_id', $customer->id)
                ->where('product_id', $id)
                ->first();
            // dd($cartItem);
            if ($cartItem) {
                // dd('Deleting cart item:', $cartItem);
                $cartItem->delete();
                return redirect()->back()->with('success', 'Product removed from cart successfully.');
            } else {
                return redirect()->back()->with('error', 'Product not found in cart.');
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product removed from cart successfully.');
            } else {
                return redirect()->back()->with('error', 'Product not found in cart.');
            }
        }
    }
}
