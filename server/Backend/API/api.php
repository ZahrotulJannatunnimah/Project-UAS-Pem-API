<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Middleware\CheckApiKey;

// Endpoint Public (Tanpa API Key)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Endpoint Protected (Wajib menggunakan API Key)
Route::middleware([CheckApiKey::class])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index']);       // GET (Read)
    Route::post('/produk', [ProdukController::class, 'store']);     // POST (Create)
    Route::put('/produk/{id}', [ProdukController::class, 'update']); // PUT (Update)
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']); // DELETE (Delete)
});