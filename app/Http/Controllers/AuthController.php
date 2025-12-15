<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        validator(request()->all(), [
            'name' => 'required|string',
            'password' => 'required|string'
        ])->validate();

        // $credentials = $request()->validate([
        //     'name' => 'required|string',
        //     'password' => 'required|string'
        // ]);

        // if(Auth::attempt($credentials)) {
        //     $user = Auth::user();
        //     $token = $user->createToken(time())->plainTextToken;
        //     return response()->json(['token' => $token], 200);
        // }

        $user = User::where('name', request('name'))->first();

        if(Hash::check(request('password'), $user->getAuthPassword())) {
            return [
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken
            ];
        }
    }

    public function logout() {
        auth()->user->currentAccessToken()->delete();
        return redirect()->route('welcome');
    }
}
