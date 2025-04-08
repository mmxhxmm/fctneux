<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckEmpresa;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\RegistradorController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\DraftController;

// User Authorization
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Pages that will run only after logging in
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/usuarios-buscar', [UserController::class, 'search'])->name('usuarios-buscar');

    // Empresa
    // Checks if empresa_draft exists, redirects to empresa-form-1 if not
    Route::middleware([CheckEmpresa::class])->group(function () {
        Route::get('/empresa-form/pagina-1', function () {
            return view('pages/form', ['form' => 'add-empresa-form-1']);
        })->name('empresa-form-1');
        Route::get('/empresa-form/pagina-2', function () {
            return view('pages/form', ['form' => 'add-empresa-form-2']);
        })->name('empresa-form-2');
        Route::get('/empresa-form/pagina-3', function () {
            return view('pages/form', ['form' => 'add-empresa-form-3']);
        })->name('empresa-form-3');
    });
    Route::post('/store-empresa-1', [EmpresaController::class, 'store_1'])->name('store-empresa-1');
    Route::post('/store-empresa-2', [EmpresaController::class, 'store_2'])->name('store-empresa-2');
    Route::post('/store-empresa-3', [EmpresaController::class, 'store_3'])->name('store-empresa-3');
    Route::post('/clear-drafts', [DraftController::class, 'clearDrafts'])->name('clear-drafts');
    // Empresa Index
    Route::get('/empresa-index', [EmpresaController::class, 'index'])->name('empresa-index');
    Route::get('/empresa-detail', [EmpresaController::class, 'index_2'])->name('empresa-detail');
    Route::get('/empresa-index-3', [EmpresaController::class, 'index_3'])->name('empresa-index-3');

    // Tareas
    Route::get('/tareas-index', [TareaController::class, 'index'])->name('tareas-index');
    Route::get('/tareas-historial', function () {
        return view('pages/tareas-historial');
    })->name('tareas-historial');
    Route::patch('/tareas/{id}/done', [TareaController::class, 'markAsDone'])->name('tarea.markAsDone');
    Route::get('/tareas-form', function () {
        return view('form-datos-tareas');
    })->name('tareas-form');
    Route::get('/tareas-busqueda', [TareaController::class, 'buscar'])->name('tareas-busqueda');

});

// Pages that only the admin can access
Route::middleware(['auth', 'role:Admin'])->group(function(){ 
    // Personal
    Route::get('/admin/personal-activo', [UserController::class, 'active'])->name('personal-activo');
    Route::get('/admin/personal-no-activo', [UserController::class, 'no_active'])->name('personal-no-activo');
    Route::get('/admin/personal-form', function () {
        return view('/admin/form-datos-personal');
    })->name('personal-form');
});

require __DIR__.'/auth.php';
