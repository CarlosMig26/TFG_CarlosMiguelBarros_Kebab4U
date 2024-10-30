<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'restaurant') {
            $userRestaurantId = $user->restaurant_id;

            $orders = Order::whereJsonContains('order_data->restaurant_id', '$userRestaurantId')
                ->orderBy('created_at', 'desc')
                ->get();

        } else {
            $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        }

        return view('orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderData = json_decode($order->order_data, true);

        $restaurantId = isset($orderData[0]['restaurant_id']) ? $orderData[0]['restaurant_id'] : null;

        $user = Auth::user();
        $alreadyRated = false;

        if ($restaurantId) {
            $alreadyRated = DB::table('restaurant_user')
                ->where('user_id', $user->id)
                ->where('restaurant_id', $restaurantId)
                ->exists();
        }

        return view('orders.show', compact('order', 'alreadyRated'));
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
    public function rateOrder(Request $request, $orderId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $order = Order::findOrFail($orderId);

        $orderData = json_decode($order->order_data, true);

        if (isset($orderData[0]['restaurant_id'])) {
            $restaurantId = $orderData[0]['restaurant_id'];
        } else {
            return redirect()->route('order.show', $order->id);
        }

        $rating = $request->input('rating');

        DB::table('restaurant_user')->updateOrInsert(
            ['user_id' => Auth::user()->id, 'restaurant_id' => $restaurantId],
            ['rating' => $rating, 'updated_at' => now()]
        );

        return redirect()->route('order.show', $order->id);
    }

}
