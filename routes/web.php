<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/cadastro', [UserController::class,'createUser'])->name('signup');
Route::post('/login', [UserController::class,'checkUser']);

Route::get('/cards_get',[CardController::class,'getCards'])->name('cards');
Route::post('/cards',[CardController::class,'createCard'])->name('card_reg');
Route::get('/cards', [CardController::class, 'showCards']);

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');
