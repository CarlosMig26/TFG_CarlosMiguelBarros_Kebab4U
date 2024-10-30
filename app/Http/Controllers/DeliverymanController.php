<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;

class DeliverymanController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();

        $preparedOrders = $orders->map(function ($order) {
            $orderData = json_decode($order->order_data, true);

            $order->guest_name = $orderData['guest_name'] ?? null;
            $order->guest_email = $orderData['guest_email'] ?? null;
            $order->guest_address = $orderData['guest_address'] ?? null;

            $dishes = array_filter($orderData, 'is_array');

            return [
                'id' => $order->id,
                'user' => $order->user,
                'guest_name' => $order->guest_name,
                'guest_email' => $order->guest_email,
                'guest_address' => $order->guest_address,
                'dishes' => $dishes,
                'status' => $order->status,
            ];
        });

        return view('delivery.index', ['orders' => $preparedOrders]);
    }

    public function acceptDeliveryApi($id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->status = 'delivering';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order status updated to delivering']);
    }

    public function completeDeliveryApi($id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->status = 'delivered';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order status updated to delivered']);
    }

    public function deleteOrderApi($id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order deleted successfully']);
    }
}
