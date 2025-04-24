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
use App\Http\Controllers\EmpresaUpdateController;
use App\Mail\UserResetEmail;
use App\Models\User;

// User Authorization
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Email Test
Route::get('email', function () {
    $user = User::find(1);

    // Mail::to('Wd4lE@example.com')->send(new RegistrationSecond($registration));

    $mail = new UserResetEmail($user);
    return $mail;
});

// Pages that will run only after logging in
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/usuarioPerfil', [ProfileController::class, 'mostrarTareas'])->name('usuarioPerfil');

    // Usuario Index
    Route::get('/usuarios-active-index', [UserController::class, 'active'])->name('user.active');
    Route::get('/usuarios-no_active-index', [UserController::class, 'no_active'])->name('user.no_active');
    Route::get('/usuarios-search', [UserController::class, 'search'])->name('user.search');
    Route::put('/usuarios-store', [UserController::class, 'store'])->name('user.add');

    // Usuario Perfil
    Route::get('/perfil', function () {
        return view('profile/perfil');
    })->name('perfil');
    Route::get('/perfil', [UserController::class, 'all'])->name('perfil');

    // Empresa Forms
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

    // Empresa Detail
    Route::put('/update-empresa/{id}', [EmpresaUpdateController::class, 'update_empresa'])->name('empresa.update');
    Route::delete('/delete-empresa/{id}', [EmpresaUpdateController::class, 'delete_empresa'])->name('empresa.delete');
    Route::put('/add-rc/{id}', [EmpresaUpdateController::class, 'add_rc'])->name('responsables.add');
    Route::put('/update-rc/{id}', [EmpresaUpdateController::class, 'update_rc'])->name('responsables.update');
    Route::delete('/delete-rc/{id}', [EmpresaUpdateController::class, 'delete_rc'])->name('responsables.delete');
    Route::put('/add-ct/{id}', [EmpresaUpdateController::class, 'add_ct'])->name('centroTrabajo.add');
    Route::put('/update-ct/{id}', [EmpresaUpdateController::class, 'update_ct'])->name('centroTrabajo.update');
    Route::delete('/delete-ct/{id}', [EmpresaUpdateController::class, 'delete_ct'])->name('centroTrabajo.delete');
    Route::put('/add-pc/{id}', [EmpresaUpdateController::class, 'add_pc'])->name('personaContacto.add');
    Route::put('/update-pc/{id}', [EmpresaUpdateController::class, 'update_pc'])->name('personaContacto.update');
    Route::delete('/delete-pc/{id}', [EmpresaUpdateController::class, 'delete_pc'])->name('personaContacto.delete');
    Route::put('/add-practica/{id}', [EmpresaUpdateController::class, 'add_practica'])->name('practica.add');
    Route::put('/update-practica/{id}', [EmpresaUpdateController::class, 'update_practica'])->name('practica.update');
    Route::delete('/delete-practica/{id}', [EmpresaUpdateController::class, 'delete_practica'])->name('practica.delete');
    Route::put('/add-tutor/{id}', [EmpresaUpdateController::class, 'add_tutor'])->name('tutor.add');
    Route::put('/update-tutor/{id}', [EmpresaUpdateController::class, 'update_tutor'])->name('tutor.update');
    Route::delete('/delete-tutor/{id}', [EmpresaUpdateController::class, 'delete_tutor'])->name('tutor.delete');
    Route::put('/add-tutor-empresa/{id}', [EmpresaUpdateController::class, 'add_tutor_empresa'])->name('tutor-empresa.add');
    Route::put('/update-tutor-empresa/{id}', [EmpresaUpdateController::class, 'update_tutor_empresa'])->name('tutor-empresa.update');
    Route::delete('/delete-tutor-empresa/{id}', [EmpresaUpdateController::class, 'delete_tutor_empresa'])->name('tutor-empresa.delete');

    // Empresa Index
    Route::get('/empresa-index', [EmpresaController::class, 'index'])->name('empresa-index');
    Route::get('/empresa-detail', [EmpresaController::class, 'index_2'])->name('empresa-detail');
    Route::get('/empresa-index-3', [EmpresaController::class, 'index_3'])->name('empresa-index-3');
    Route::get('/empresas/filtros', [EmpresaController::class, 'filtro'])->name('empresa.filtro');


    // Tareas
    Route::get('/tareas-index', [TareaController::class, 'index'])->name('tareas-index');
    Route::get('/tareas-historial', function () {
        return view('pages/tareas-historial');
    })->name('tareas-historial');
    Route::get('/tareas-store', [TareaController::class, 'store'])->name('tareas-store');
    // Route::put('/tareas-store/{id}', [TareaController::class, 'store'])->name('tareas-store');
    Route::patch('/tareas/{id}/done', [TareaController::class, 'markAsDone'])->name('tarea.markAsDone');
    Route::get('/tareas-form', function () {
        return view('form-datos-tareas');
    })->name('tareas-form');
    Route::get('/tareas-busqueda', [TareaController::class, 'buscar'])->name('tareas-busqueda');
    Route::get('/tareas-filtro', [TareaController::class, 'asignado_filtro'])->name('tareas.filtro');

});

// Pages that only the admin can access
Route::middleware(['auth', 'role:admin'])->group(function(){ 
    // Personal
    Route::get('/personal-form', function () {
        return view('pages/user/form-datos-personal');
    })->name('personal-form');
});

require __DIR__.'/auth.php';
