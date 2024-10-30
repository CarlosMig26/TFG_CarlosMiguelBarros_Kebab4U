<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.profile');
    }
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'birthday' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d'),
            function ($attribute, $value, $fail) {
                $age = Carbon::parse($value)->diffInYears(Carbon::now());
                if ($age < 18) {
                    return $fail('Debes tener al menos 18 años.');
                }
            }],
            'password' => 'nullable|string|min:8|confirmed',
            'current_password' => 'required_with:password|string|min:8',
            'password_confirmation' => 'required_with:password|string|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])->withInput();
            }
            $user->password = Hash::make($request->password);
        }

        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthday = $request->birthday;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('principal')->with('success', 'Usuario eliminado correctamente.');
    }
    public function showCard()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        $orderCounts = $orders->groupBy(function ($order) {
            return $order->order_data['restaurant_id'];
        })->map(function ($group) {
            return $group->count();
        });

        return view('user.card', compact('orderCounts'));
    }
}
