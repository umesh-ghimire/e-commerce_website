<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
   public function redirectToGoogle()
{
    return Socialite::driver('google')
        

        ->redirect();
}

public function handleGoogleCallback(Request $request)
{
    if ($request->has('error')) {
        return redirect('/login')->with('error', 'Google login cancelled');
    }

    try {
        $googleUser = Socialite::driver('google')

            ->user();
    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Google authentication failed');
    }

    $user = User::firstOrCreate(
        ['email' => $googleUser->email],
        [
            'name' => $googleUser->name,
            'password' => Hash::make(uniqid()),
        ]
    );

    Auth::login($user);

      return redirect('/');
}
}
