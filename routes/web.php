<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Pagina_Inicial', function () {
    return view('Pagina_Inicial'); 
});
    
Route::get('/Navbar', function () {
    return view('Navbar'); 
});
    

use App\Http\Controllers\UsersController;
Route::get('/CRUD_Usuario', [UsersController::class, 'index']);

use App\Http\Controllers\AdmController;
Route::get('/CRUD_Adm', [AdmController::class, 'index']);





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth'])->group(function () {

        // Rotas do CRUD Usuario Comum
        Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('index');
        Route::post('/users', [App\Http\Controllers\UsersController::class, 'store'])->name('store');
        Route::put('/users/{id}', [App\Http\Controllers\UsersController::class, 'update'])->name('update');
        Route::delete('/users/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('destroy');
        Route::get('/users/create', [App\Http\Controllers\UsersController::class, 'create'])->name('create');
        
        // ==== ADICIONE ESTA PARTE PARA O AdmController ====
        Route::get('/admin/users', [App\Http\Controllers\AdmController::class, 'index'])->name('adm.index');
        Route::post('/admin/users', [App\Http\Controllers\AdmController::class, 'store'])->name('adm.store');
        Route::put('/admin/users/{id}', [App\Http\Controllers\AdmController::class, 'update'])->name('adm.update');
        Route::delete('/admin/users/{id}', [App\Http\Controllers\AdmController::class, 'destroy'])->name('adm.destroy');
        // ==================================================
});





//Login
Route::post('/login', function () {
    return 'Autenticação de Usuário';
})->name('login');






require __DIR__.'/auth.php';
