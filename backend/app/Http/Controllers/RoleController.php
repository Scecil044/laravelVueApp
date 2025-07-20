<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getRoles()
    {
        try{
            $roles = Role::all();
            return response()->json([
                "data"=> $roles,
                "message"=> "System roles fetched successfully."
            ], 200);
        }catch(\Exception $e){
            return response()->json([
            'error' => 'Could not fetch system roles.',
            'message' => $e->getMessage()
        ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createrole(RoleRequest $request)
    {
            try {
        $role = Role::create([
            'roleName' => $request->input('roleName'),
        ]);

        return response()->json([
            'message' => 'Role created successfully.',
            'data' => $role
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Could not create role.',
            'message' => $e->getMessage()
        ], 500);
    }

    }

    /**
     * Display the specified resource.
     */
    public function getRoleById(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            return response()->json([
                'data' => $role,
                'message' => 'Role fetched successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Could not fetch role.',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateRole(RoleRequest $request, string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->update($request->only(['roleName', 'description']));
            return response()->json([
                'message' => 'Role updated successfully.',
                'data' => $role
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Could not update role.',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function deleteRole(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return response()->json([
                'message' => 'Role deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Could not delete role.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
