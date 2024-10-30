<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $comments = Comment::where('restaurant_id', $id)->with('user', 'likes')->get();
        $user = Auth::user();

        $hasOrdered = false;
        if ($user) {
            $orders = Order::where('user_id', $user->id)->get();
            foreach ($orders as $order) {
                $orderItems = json_decode($order->order_data, true);
                if (is_array($orderItems)) {
                    foreach ($orderItems as $item) {
                        if (isset($item['restaurant_id']) && $item['restaurant_id'] == $id) {
                            $hasOrdered = true;
                            break 2;
                        }
                    }
                }
            }
        }
        return view('restaurant.comments', compact('restaurant', 'comments', 'hasOrdered'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'commentText' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $comment = new Comment();
        $comment->commentText = $request->commentText;
        $comment->user_id = $user->id;
        $comment->restaurant_id = $id;
        $comment->likes = 0;
        $comment->save();

        $has_ordered = false;

        return redirect()->route('restaurant.comments', $id);
    }
    public function like($id)
    {
        $comment = Comment::find($id);
        $user = Auth::user();

        if ($comment && !$comment->hasLikedBy($user)) {
            $comment->likes()->attach($user->id);
            $comment->increment('likes');
        }

        return back();
    }

    public function unlike($id)
    {
        $comment = Comment::find($id);
        $user = Auth::user();

        if ($comment && $comment->hasLikedBy($user)) {
            $comment->likes()->detach($user->id);
            $comment->decrement('likes');
        }

        return back();
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->restaurantReply = $request->reply;
        $comment->save();

        return redirect()->back()->with('success', 'Respuesta añadida.');
    }
}
