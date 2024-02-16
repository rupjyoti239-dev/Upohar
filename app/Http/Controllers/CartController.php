<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Add the product to the cart if it's not already in the cart
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image, 
            ];
        }

        // Store the updated cart data back in the session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }



    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.cart', compact('cart'));
    }




    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Remove the item from the cart
            unset($cart[$id]);
            // Update the cart session
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item removed from cart successfully.');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }
}
