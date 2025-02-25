<?php

namespace App\Http\Controllers;

use \Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $registerUserData = $request->validate
        ([
            'name'=>'string|required',
            'email'=>'email|required|unique:users',
            'password'=>'string|required|min:8',
            'role'=>'string|required|in:Admin,User'
        ]);

       $user = User::create([
           'name'=>$registerUserData['name'],
           'email'=>$registerUserData['email'],
           'password'=>Hash::make ($registerUserData['password']),
           'role'=>$registerUserData['role']
        ]);

       return response()->json([
           'message'=>'User Created!',
           'data' => $user
       ],201);
    }

    public function login(Request $request): JsonResponse
    {
        $loginUserData = $request->validate
        ([
            'email'=>'email|required',
            'password'=>'string|required|min:8'
        ]);

        if(!Auth::attempt($loginUserData)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        return response()->json([
            'message'=> 'User Logged In',
            'data' => Auth::user()
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json([
            'message'=> 'User Logged Out'
        ]);
    }

}
