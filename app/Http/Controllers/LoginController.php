<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRestRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function usrSignupForm()
    {
        return view('auth.register');
    }

    public function usrSignup(RegisterUserRequest $request)
{
    $user = new User();
    $user->fullName = $request->get('fullName');
    $user->email = $request->get('email');
    $user->phone = $request->get('phone');
    $user->address = $request->get('address');
    $user->role = 'client';
    $user->birthday = $request->get('birthDay');
    $user->password = Hash::make($request->get('password'));

    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
    }

    $user->save();

    Auth::login($user);
    $request->session()->put('user_id', $user->id);

    return redirect()->route('principal')->with('status', 'Has iniciado sesión correctamente.');
}


    public function restSignupForm()
    {
        return view('auth.register');
    }

    public function restSignup(RegisterRestRequest $request)
    {
        $user = new User();
        $user->fullName = $request->get('resName');
        $user->email = $request->get('resEmail');
        $user->phone = $request->get('resPhone');
        $user->address = $request->get('resAddress');
        $user->role = 'restaurant';
        $user->birthday = $request->get('inaugurationDate');
        $user->password = Hash::make($request->get('resPassword'));
        $user->save();

        Auth::login($user);
        $request->session()->put('user_id', $user->id);

        return redirect()->route('principal')->with('status', 'Has iniciado sesión correctamente.');
    }

    public function loginForm()
    {
        if (Auth::viaRemember()) {
            return 'Bienvenido de nuevo';
        } elseif (Auth::check()) {
            return redirect()->route('principal')->with('status', 'Has iniciado sesión correctamente.');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentialsFullName = ['fullName' => $request->input('fullName'), 'password' => $request->input('password')];
        $credentialsEmail = ['email' => $request->input('fullName'), 'password' => $request->input('password')];
        $rememberLogin = $request->get('remember') ? true : false;

        if (Auth::guard('web')->attempt($credentialsFullName, $rememberLogin) || Auth::guard('web')->attempt($credentialsEmail, $rememberLogin)) {
            $request->session()->regenerate();
            $request->session()->put('user_id', Auth::user()->id);
            return redirect()->route('principal')->with('status', 'Has iniciado sesión correctamente.');
        }

        $error = 'Error al acceder a la aplicación';
        return view('auth.login', compact('error'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('principal')->with('status', 'Has cerrado sesión correctamente.');
    }
}
