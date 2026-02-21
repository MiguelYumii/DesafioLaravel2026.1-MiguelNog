<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdmController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/Pagina_Inicial', function () {
    return view('Pagina_Inicial'); 
});
    
Route::get('/Navbar', function () {
    return view('Navbar'); 
});
    

Route::get('/CRUD_Usuario', [UsersController::class, 'index']);
Route::get('/CRUD_Adm', [UsersController::class, 'index']);
Route::get('/CRUD_Produtos', [ProductController::class, 'index']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




// ======== Modais das Tabelas =========//

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('index');


Route::middleware(['auth'])->group(function () {

        Route::get('/users/create', [App\Http\Controllers\UsersController::class, 'create'])->name('create');
        Route::post('/users', [App\Http\Controllers\UsersController::class, 'store'])->name('store');
        Route::put('/users/{id}', [App\Http\Controllers\UsersController::class, 'update'])->name('update');
        Route::delete('/users/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('destroy');

        Route::get('/admin/users', [App\Http\Controllers\AdmController::class, 'index'])->name('adm.index');
        Route::post('/admin/users', [App\Http\Controllers\AdmController::class, 'store'])->name('adm.store');
        Route::put('/admin/users/{id}', [App\Http\Controllers\AdmController::class, 'update'])->name('adm.update');
        Route::delete('/admin/users/{id}', [App\Http\Controllers\AdmController::class, 'destroy'])->name('adm.destroy');
      
      });
        // ==================================================





Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');

// ======== Modais das Tabelas PRODUTOS =========//

Route::middleware(['auth'])->group(function () {

    Route::get('/products', [ProductController::class, 'index'])->name('index');
    Route::post('/products', [ProductController::class, 'store'])->name('store');
    Route::put('/products/{product_id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/products/{product_id}', [ProductController::class, 'destroy'])->name('destroy');     
});
// =====================================//




require __DIR__.'/auth.php';
