<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/auth/register", [AuthController::class, "register"])->name("register");
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth/resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/auth/forgotPassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword');

// Protected user info route
Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
    return response()->json([
        'user' => $request->user()
    ]);
});

/**
 * =============================================================================
 * Role Management Routes
 * =============================================================================
 */
Route::get('/roles', [RoleController::class, 'getRoles']);
Route::post('/roles', [RoleController::class, 'createrole']);
Route::get('/roles/{id}', [RoleController::class, 'getRoleById']);
Route::put('/roles/{id}', [RoleController::class, 'updateRole']);
Route::delete('/roles/{id}', [RoleController::class, 'deleteRole']);

// Protected user routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show']);
    Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
    Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);
});
