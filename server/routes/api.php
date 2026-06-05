<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\KategoriController;

use App\Http\Controllers\AuthController;

// Auth — tidak perlu API Key
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login',    [AuthController::class, 'login']);

// Semua route di sini wajib pakai API Key
Route::middleware('apikey')->group(function () {

    // Produk
    Route::get('/produk',          [ProdukController::class, 'index']);
    Route::get('/produk/{id}',     [ProdukController::class, 'show']);
    Route::post('/produk',         [ProdukController::class, 'store']);
    Route::put('/produk/{id}',     [ProdukController::class, 'update']);
    Route::delete('/produk/{id}',  [ProdukController::class, 'destroy']);

    // Kategori
    Route::get('/kategori',        [KategoriController::class, 'index']);
    Route::get('/kategori/{id}',   [KategoriController::class, 'show']);
    Route::post('/kategori',       [KategoriController::class, 'store']);
    Route::put('/kategori/{id}',   [KategoriController::class, 'update']);
    Route::delete('/kategori/{id}',[KategoriController::class, 'destroy']);

    // Pelanggan
    Route::get('/pelanggan',       [PelangganController::class, 'index']);
    Route::get('/pelanggan/{id}',  [PelangganController::class, 'show']);
    Route::post('/pelanggan',      [PelangganController::class, 'store']);
    Route::put('/pelanggan/{id}',  [PelangganController::class, 'update']);
    Route::delete('/pelanggan/{id}',[PelangganController::class, 'destroy']);

    // Pesanan
    Route::get('/pesanan',         [PesananController::class, 'index']);
    Route::get('/pesanan/{id}',    [PesananController::class, 'show']);
    Route::post('/pesanan',        [PesananController::class, 'store']);
    Route::put('/pesanan/{id}',    [PesananController::class, 'update']);
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy']);

});