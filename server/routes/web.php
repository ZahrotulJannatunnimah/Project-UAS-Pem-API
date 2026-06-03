<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiKeyController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::post('/api-key/generate', [ApiKeyController::class, 'generate'])->name('api-key.generate');
    Route::delete('/api-key/delete', [ApiKeyController::class, 'delete'])->name('api-key.delete');
});