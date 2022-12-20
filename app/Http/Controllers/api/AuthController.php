<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        $token = $user->createToken('auth-sanctum')->plainTextToken;

        event(new Registered($user));
        auth()->login($user);

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // if (!$user) {
        //     return response([
        //         'message' => 'Bad Credential'
        //     ], 401);
        // }

        if (!Auth::attempt($request->all())) {
            return response(['message' => 'Invalid Credential'], 401);
        }

        if ($user->email_verified_at == null) {
            return response(['message' => 'Verifikasi Email Terlebih dahulu'], 401);
        }





        return response()->json([
            'data' => $user,
            'access_token' => $user->createToken('auth-sanctum')->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }


    public function logout(Request $request)
    {
        /** @var \App\Models\User $user **/
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged Out!'
        ];
    }
}