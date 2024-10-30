<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignUpApiController extends Controller
{
    public function verifyEmail(Request $request){
        return ['verifyEmail' => User::where('email', $request->email)->count()];
    }
}
