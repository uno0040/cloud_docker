<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::put('/cadastro', [UserController::class,'createUser']);

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');
