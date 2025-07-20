<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

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

Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show']);
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);
