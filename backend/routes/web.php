<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('reset-password/{token}', function ($token) {
    $email = request('email');
    return redirect("http://localhost:5173/auth/reset-password?token=$token&email=$email");
})->name('password.reset');
