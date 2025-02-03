<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\RegistradorController;

Route::get('/', function () {
    return view('welcome');
});

// User Authorization
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:coordinador'])->group(function(){
    Route::get('/coordinador/dashboard', [CoordinadorController::class, 'dashboard'])->name('coordinador.dashboard');
});

Route::middleware(['auth', 'role:registrador'])->group(function(){
    Route::get('/registrador/dashboard', [RegistradorController::class, 'dashboard'])->name('registrador.dashboard');
});

require __DIR__.'/auth.php';
