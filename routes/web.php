<?php

use App\Http\Controllers\UserDBController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\RegistradorController;

// Route::get('/', function () {
//     return view('welcome');
// });

// User Authorization
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Pages that will run only after logging in
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Empresa
    Route::get('/empresa-index', function () {
        return view('empresa-index');
    })->middleware(['auth', 'verified'])->name('empresa-index');

    // Usuario
    Route::get('/usuario', function () {
        return view('usuario');
    })->middleware(['auth', 'verified'])->name('usuario');
    
    // Tareas
    Route::get('/tareas-index', function () {
        return view('tareas-index');
    })->middleware(['auth', 'verified'])->name('tareas-index');
    Route::get('/tareas-historial', function () {
        return view('tareas-historial');
    })->middleware(['auth', 'verified'])->name('tareas-historial');
    Route::get('/datos-tareas', function () {
        return view('form-datos-tareas');
    })->middleware(['auth', 'verified'])->name('form-datos-tareas');
    
    // Personal
    Route::get('/personal-activo', function () {
        return view('personal-activo');
    })->middleware(['auth', 'verified'])->name('personal-activo');
    Route::get('/personal-suspendidos', function () {
        return view('personal-suspendidos');
    })->middleware(['auth', 'verified'])->name('personal-suspendidos');
    Route::get('/datos-personal', function () {
        return view('form-datos-personal');
    })->middleware(['auth', 'verified'])->name('form-datos-personal');
    
    
    
    // Route::get('/empresa', [ProfileController::class, 'show'])->name('empresa');
});

// Pages that only the admin can access
// Features an example of how to utilize roles to make permission limitations in blade
Route::middleware(['auth', 'role:admin'])->group(function(){ 
    Route::get('/test', [UserDBController::class, 'index'])->name('test');
});

// ADMIN ROLE INSIDE BLADE
// @if (Auth::user()->role == 'admin')
// {{ __("You are a :role", ['role' => Auth::user()->role]) }}

require __DIR__.'/auth.php';
