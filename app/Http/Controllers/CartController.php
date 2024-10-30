<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $dish = Dish::findOrFail($request->id);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$dish->id])) {
            $cart[$dish->id]['quantity']++;
        } else {
            $cart[$dish->id] = [
                "id" => $dish->id,
                "name" => $dish->name,
                "price" => $dish->price,
                "quantity" => 1,
                "image" => $dish->image,
                "restaurant_id" => $dish->restaurant_id,
                "restaurant_address" => $dish->restaurant->address,
                "discount" => $dish->discount,
            ];
        }

        $request->session()->put('cart', $cart);

        return back();
    }

    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        if (isset($request->id) && isset($request->quantity)) {
            $cart = $request->session()->get('cart', []);
            if (isset($cart[$request->id])) {
                $cart[$request->id]['quantity'] = $request->quantity;
                $request->session()->put('cart', $cart);
            }
            return redirect()->route('cart.index')->with('success_msg', 'Cart updated successfully!');
        }
    }

    public function showCart()
    {
        $cart_dishes = collect(session()->get('cart', []));
        $cart_total = 0;
        foreach ($cart_dishes as $dish) {
            $discounted_price = $dish['price'] * (1 - $dish['discount'] / 100);
            $cart_total += $dish['quantity'] * $discounted_price;
        }

        $total_dishes_count = $cart_dishes->count();
        return view('shoppingcart.index', compact('cart_dishes', 'cart_total', 'total_dishes_count'));
    }

    public function destroy(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success_msg', 'Dish removed from cart successfully!');
    }
    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'card_number' => 'required|string|min:16|max:16',
                'expiry_date' => 'required|string|max:5',
                'cvv' => 'required|string|min:3|max:4',
            ]);
        } else {
            $request->validate([
                'card_number' => 'required|string|min:16|max:16',
                'expiry_date' => 'required|string|max:5',
                'cvv' => 'required|string|min:3|max:4',
            ]);
        }

        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('alert_msg', 'Your cart is empty.');
        }

        $order_data = array_merge($cart, [
            'guest_name' => $request->input('name'),
            'guest_email' => $request->input('email'),
            'guest_address' => $request->input('address'),
            'card_number' => $request->input('card_number'),
            'expiry_date' => $request->input('expiry_date'),
            'cvv' => $request->input('cvv'),
        ]);

        $order = new Order();
        $user = new User();
        $order->order_data = json_encode($order_data);
        $order->status = 'pending';

        if (Auth::check()) {
            $payment_methods = [
                'card_number' => $request->input('card_number'),
                'expiry_date' => $request->input('expiry_date'),
                'cvv' => $request->input('cvv'),
            ];

            $user = Auth::user();
            $order->user_id = $user->id;
            $user->paymentMethods = json_encode($payment_methods);
            $user->save();
        }

        $order->save();
        $request->session()->forget('cart');

        if (Auth::check()) {
            return view('shoppingcart.receipt', compact('order', 'user'));
        } else {
            return view('shoppingcart.receipt', compact('order'));
        }
    }
}
