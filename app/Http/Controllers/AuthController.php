<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $credentials = $request->only('email', 'password');

       if($token = Auth::attempt($credentials)){
           return response()->json($this->respondWithToken($token));
       }

       return response()->json(['message' => 'Unauthorized'], 401);
    }

    private function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::now()->timestamp + Auth::factory()->getTTL() * 60
        ];
    }
}
