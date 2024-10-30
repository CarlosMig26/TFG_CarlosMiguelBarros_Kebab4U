<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DeliverymanController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::middleware('deliveryman')->group(function () {
    Route::get('/delivery', [DeliverymanController::class, 'index'])->name('delivery');

    Route::get('/delivery/profile', function () {
        return view('delivery.profile');
    })->name('delivery.profile');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('user', UserController::class);
});

Route::get('/locale/{lang}', [LanguageController::class, 'changeLanguage'])->name('change.language');

Route::middleware('notDeliveryman')->group(function () {
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'destroy'])->name('cart.remove');
    Route::get('/cart/receipt', [CartController::class, 'receipt'])->name('cart.receipt');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');

    Route::resource('restaurant', RestaurantController::class)->only(['create', 'store'])->middleware('admin');
    
    Route::middleware('restaurant')->group(function () {
        Route::resource('restaurant', RestaurantController::class)->only(['create', 'store', 'edit', 'update', 'destroy', 'show']);
    });

    Route::get('/', [RestaurantController::class, 'index'])->name('principal');
    Route::resource('restaurant', RestaurantController::class)->only(['index', 'show', 'create', 'store']);
    Route::get('/search', [RestaurantController::class, 'search'])->name('restaurant.search');
    Route::get('/results', [RestaurantController::class, 'search'])->name('restaurant.results');
    Route::get('restaurants/discount', [RestaurantController::class, 'discount'])->name('restaurant.discount');

    Route::middleware('client')->group(function () {
        Route::post('/restaurant/{id}/favourite', [RestaurantController::class, 'favourite'])->name('restaurant.favourite');
        Route::delete('/restaurant/{id}/unfavourite', [RestaurantController::class, 'unfavourite'])->name('restaurant.unfavourite');
        Route::get('/favourites', [RestaurantController::class, 'favRestaurants'])->name('restaurant.favourites');
        Route::post('/orders/{order}/rate', [OrderController::class, 'rateOrder'])->name('order.rate');
    });

    Route::get('/restaurants/{id}/comments', [CommentController::class, 'show'])->name('restaurant.comments');

    Route::middleware('auth')->group(function () {
        Route::get('/user/card', [UserController::class, 'showCard'])->name('user.card');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('comments/{id}/like', [CommentController::class, 'like'])->name('comment.like');
        Route::post('comments/{id}/unlike', [CommentController::class, 'unlike'])->name('comment.unlike');
        Route::post('comments/{id}/reply', [CommentController::class, 'reply'])->name('restaurant.reply');
        Route::post('comments/{restaurant}/store', [CommentController::class, 'store'])->name('comments.store');
    });

    Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::get('registerUsr', [LoginController::class, 'usrSignupForm'])->name('usrSignupForm');
    Route::post('registerUsr', [LoginController::class, 'usrSignup'])->name('usrSignup');
    Route::get('registerRest', [LoginController::class, 'restSignupForm'])->name('restSignupForm');
    Route::post('registerRest', [LoginController::class, 'restSignup'])->name('restSignup');

    Route::put('/dishes/{dish}', [DishController::class, 'update'])->name('dishes.update');

    Route::resource('order', OrderController::class);

    Route::resource('comment', CommentController::class);
    Route::resource('dishes', DishController::class);

    Route::get('/map', [RestaurantController::class, 'showMap'])->name('map');



    Route::get('/testroute', function () {
        $name = "Funny Coder";
        Mail::to('Kcarlos2003@gmail.com')->send(new WelcomeMail($name));
    });
});
