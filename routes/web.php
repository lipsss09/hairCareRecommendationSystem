<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\CartController;

use App\Http\Controllers\HairAssessmentController;
Route::get('/', function () {
     return view('welcome');
});


Route::get('/login', [AuthController::class , 'showLogin'])->name('login');
Route::post('/login', [AuthController::class , 'login']);
Route::post('/update', [AuthController::class , 'updateProfile'])->name('profile.update');

Route::get('/register', [AuthController::class , 'showRegister']);
Route::post('/register', [AuthController::class , 'register'])->name('register');

Route::post('/logout', [AuthController::class , 'logout']);

Route::get('/get-products', [ProsesController::class , 'filterProducts'])->name('products.filter');


Route::get('/dashboard', [ContentController::class , 'dashboard'])->middleware('auth')->name('dashboard');
// ✅ Ganti jadi ini
Route::get('/permasalahan', [HairAssessmentController::class , 'create'])
     ->middleware('auth')
     ->name('permasalahan');

// Route untuk halaman form input masalah rambut
// Dibungkus middleware auth agar hanya user yang login bisa akses
Route::middleware(['auth'])->group(function () {
     Route::get('/hair-problem', [HairAssessmentController::class , 'create'])
          ->name('hair.assessment.create');

     Route::post('/hair-problem', [HairAssessmentController::class , 'store'])
          ->name('hair.assessment.store');

     // Cart routes
     Route::get('/cart', [CartController::class , 'index'])->name('cart.index');
     Route::post('/cart', [CartController::class , 'store'])->name('cart.store');
     Route::delete('/cart/{id}', [CartController::class , 'destroy'])->name('cart.destroy');
});
