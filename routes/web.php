<?php

use App\Http\Controllers\UserDBController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\RegistradorController;
use App\Http\Controllers\EmpresaController;

// User Authorization
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Pages that will run only after logging in
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Forms
    Route::get('/empresa-form', [EmpresaController::class, 'index']);
    Route::post('/store-empresa', [EmpresaController::class, 'store']);

    // Empresa
    Route::get('/empresa-index', function () {
        return view('empresa-index');
    })->name('empresa-index');
    
    // Tareas
    Route::get('/tareas-index', function () {
        return view('tareas-index');
    })->name('tareas-index');
    Route::get('/tareas-historial', function () {
        return view('tareas-historial');
    })->name('tareas-historial');
    Route::get('/datos-tareas', function () {
        return view('form-datos-tareas');
    })->name('form-datos-tareas');
    
    // Personal
    Route::get('/personal-activo', function () {
        return view('personal-activo');
    })->name('personal-activo');
    Route::get('/personal-suspendidos', function () {
        return view('personal-suspendidos');
    })->name('personal-suspendidos');
    Route::get('/datos-personal', function () {
        return view('form-datos-personal');
    })->name('form-datos-personal');
    
    // Route::get('/empresa', [ProfileController::class, 'show'])->name('empresa');
});

// Pages that only the admin can access
// Features an example of how to utilize roles to make permission limitations in blade -> Replace this later
Route::middleware(['auth', 'role:Admin'])->group(function(){ 
    Route::get('/personal-activo', [UserDBController::class, 'index'])->name('personal-activo');
});

require __DIR__.'/auth.php';
