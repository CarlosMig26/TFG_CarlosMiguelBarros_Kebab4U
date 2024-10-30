<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'n-name' => 'required|string|max:255',
            'n-description' => 'required|string',
            'n-ingredients' => 'required|string',
            'n-price' => 'required|numeric|min:1|max:999',
            'n-discount' => 'required|numeric|min:0|max:100',
            'n-image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dish = new Dish();
        $dish->name = $request->input('n-name');
        $dish->description = $request->input('n-description');
        $dish->ingredients = $request->input('n-ingredients');
        $dish->price = $request->input('n-price');
        $dish->discount = $request->input('n-discount', 0);

        if ($request->hasFile('n-image')) {
            $imagePath = $request->file('n-image')->store('dishes', 'public');
            $dish->image = $imagePath;
        }

        $dish->restaurant_id = auth()->user()->restaurant_id;
        $dish->save();

        return redirect()->route('restaurant.edit', ['restaurant' => $dish->restaurant_id])
            ->with('success_msg', 'Plato agregado exitosamente.');
    }

    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'd-name' => 'required|string|max:255',
            'd-description' => 'nullable|string',
            'd-ingredients' => 'nullable|string',
            'd-price' => 'required|numeric|min:1|max:999',
            'd-discount' => 'nullable|numeric|min:0|max:100',
            'd-image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dish->name = $request->input('d-name');
        $dish->description = $request->input('d-description');
        $dish->ingredients = $request->input('d-ingredients');
        $dish->price = $request->input('d-price');
        $dish->discount = $request->input('d-discount');

        if ($request->hasFile('d-image')) {
            if ($dish->image) {
                Storage::delete('public/' . $dish->image);
            }
            $imagePath = $request->file('d-image')->store('images/dishes', 'public');
            $dish->image = $imagePath;
        }

        $dish->save();

        return redirect()->route('restaurant.edit', $dish->restaurant_id);
    }

    public function destroy(Dish $dish)
    {
        if ($dish->image) {
            Storage::delete('public/' . $dish->image);
        }

        $dish->delete();
        return redirect()->route('restaurant.edit', $dish->restaurant_id)
            ->with('success_msg', 'Plato eliminado exitosamente.');
    }
}
