<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurant.index', compact('restaurants'));
    }
    public function create()
    {
        if (Auth::check() && (Auth::user()->role === 'admin')) {
            return view('restaurant.create');
        } else {
            return redirect()->route('principal')->with('errors', 'No tienes permiso para acceder a esta página.');
        }
    }
    public function store(Request $request)
    {
        if (Auth::check() && (Auth::user()->role === 'admin')) {
            $restaurant = new Restaurant($request->all());
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('restaurant_images', 'public');
                $restaurant->image = $imagePath;
            }
            $restaurant->save();

            return redirect()->route('restaurant.show', $restaurant);
        } else {
            return redirect()->route('principal')->with('errors', 'No tienes permiso para realizar esta acción.');
        }
    }
    public function show(Restaurant $restaurant)
    {
        $restaurant->load('dishes');
        return view('restaurant.show', compact('restaurant'));
    }
    public function edit(Restaurant $restaurant)
    {
        $restaurant = Restaurant::findOrFail($restaurant->id);
        return view('restaurant.edit', compact('restaurant'));
    }
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'schedule' => 'required|string',
            'has_discount' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->tags = $request->input('tags');
        $restaurant->address = $request->input('address');
        $restaurant->phone = $request->input('phone');
        $restaurant->email = $request->input('email');
        $restaurant->schedule = $request->input('schedule');

        if ($request->hasFile('image')) {
            if ($restaurant->image) {
                Storage::delete('public/' . $restaurant->image);
            }

            $imagePath = $request->file('image')->store('restaurant_images', 'public');
            $restaurant->image = $imagePath;
        }

        $restaurant->has_discount = $request->has('has_discount') ? 1 : 0;

        $restaurant->save();

        return redirect()->route('restaurant.edit', $restaurant);
    }
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('principal')->with('success_msg', 'Restaurante eliminado correctamente.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $filter = $request->input('filter');

        $query = strtolower($query);

        switch ($filter) {
            case 'tags':
                $restaurants = Restaurant::whereRaw("LOWER(unaccent(tags)) LIKE LOWER(unaccent(?))", ["%{$query}%"])->get();
                break;
            case 'address':
                $restaurants = Restaurant::whereRaw("LOWER(unaccent(address)) LIKE LOWER(unaccent(?))", ["%{$query}%"])->get();
                break;
            case 'name':
            default:
                $restaurants = Restaurant::whereRaw("LOWER(unaccent(name)) LIKE LOWER(unaccent(?))", ["%{$query}%"])->get();
                break;
        }

        return view('restaurant.results', compact('restaurants', 'query', 'filter'));
    }
    public function discount()
    {
        $restaurants = Restaurant::where('has_discount', true)->get();
        return view('restaurant.discount', compact('restaurants'));
    }
    public function showMap()
    {
        $restaurants = Restaurant::all();
        return view('map.map', compact('restaurants'));
    }
    public function favourite($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $user = Auth::user();

        $favourites = $user->favourites ?? [];
        if (in_array($id, $favourites)) {
            return redirect()->route('restaurant.show', $restaurant)->with('errors', 'El restaurante ya está en tus favoritos.');
        }

        $favourites[] = (string) $id;
        $user->favourites = $favourites;
        $user->save();

        return redirect()->route('restaurant.show', $restaurant)->with('success', 'Restaurante agregado a tus favoritos.');
    }
    public function unfavourite($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $user = Auth::user();

        $favourites = $user->favourites ?? [];
        if (!in_array($id, $favourites)) {
            return redirect()->route('restaurant.show', $restaurant)->with('errors', 'El restaurante no está en tus favoritos.');
        }

        $favourites = array_diff($favourites, [(string) $id]);
        $user->favourites = $favourites;
        $user->save();

        return redirect()->back()->with('success', 'Restaurante eliminado de tus favoritos.');
    }
    public function favRestaurants()
    {
        $user = Auth::user();
        $favouriteRestaurants = collect();

        if ($user->favourites != null) {
            $favourites = $user->favourites;
            $favouriteRestaurants = Restaurant::whereIn('id', $favourites)->get();
        }

        return view('restaurant.favourites', compact('favouriteRestaurants'));
    }
}
