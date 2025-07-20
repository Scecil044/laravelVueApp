<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

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

    public function forgotPassword(Request $request){
        try{
            $request->validate(['email' => 'required|email']);
            
            $status = Password::sendResetLink(
                $request->only('email')
            );
            
            if ($status === Password::RESET_LINK_SENT) {
                return response()->json(['message' => 'Password reset link sent to your email']);
            } else {
                return response()->json(['error' => 'Unable to send reset link'], 400);
            }
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function resetPassword(Request $request){
        try{
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);
            
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = bcrypt($password);
                    $user->save();
                }
            );
            
            if ($status === Password::PASSWORD_RESET) {
                return response()->json(['message' => 'Password has been reset successfully']);
            } else {
                return response()->json(['error' => 'Invalid token or email'], 400);
            }
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            if ($request->user()) {
                $request->user()->currentAccessToken()->delete();
            }
            return response()->json(['message' => 'Logged out successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
