<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        try{
            $user = User::create([
                "firstName"=> $request->input('firstName'),
                "lastName"=> $request->input('lastName'),
                "middleName"=> $request->input('middleName'),
                "email"=> $request->input('email'),
                "password"=> bcrypt($request->input('password')),
                "role" => $request->input('role'), // role is the foreign key to roles.id
            ]);
            $user->load('role');
            $user->makeHidden(['password']);
            return response()->json([
                'status'=> 'success',
                'user'=> $user

            ]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $user->load('role');
            $user->makeHidden(['password']);
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Login failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
