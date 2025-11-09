<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

Route::get('/api/buscar', [EnderecoController::class, 'buscar'])->name('buscar');

Route::get('/api/users', [UserController::class, 'index']);
Route::post('/api/users', [UserController::class, 'store']);
Route::put('/api/users/{id}', [UserController::class, 'update']);
Route::delete('/api/users/{id}', [UserController::class, 'destroy']);
