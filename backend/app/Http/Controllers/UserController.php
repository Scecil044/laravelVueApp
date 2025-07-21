<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        try {
            $users = User::with('role')->get();
            return response()->json(['data' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not fetch users', 'message' => $e->getMessage()], 500);
        }
    }

    // Show a single user
    public function show($id)
    {
        try {
            $user = User::with('role')->findOrFail($id);
            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found', 'message' => $e->getMessage()], 404);
        }
    }

    // Create a new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
        ]);
        try {
            $user = User::create([
                'firstName' => $validated['firstName'],
                'lastName' => $validated['lastName'],
                'middleName' => $validated['middleName'] ?? null,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);
            $user->load('role');
            $user->makeHidden(['password']);
            return response()->json(['message' => 'User created successfully', 'data' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create user', 'message' => $e->getMessage()], 500);
        }
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'firstName' => 'sometimes|required|string|max:255',
            'lastName' => 'sometimes|required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'email' => ['sometimes','required','email','max:255', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'sometimes|required|exists:roles,id',
        ]);
        try {
            $user = User::findOrFail($id);
            $user->fill($validated);
            if (isset($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }
            $user->save();
            $user->load('role');
            $user->makeHidden(['password']);
            return response()->json(['message' => 'User updated successfully', 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not update user', 'message' => $e->getMessage()], 500);
        }
    }

    // Delete a user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not delete user', 'message' => $e->getMessage()], 500);
        }
    }
}
