<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\UsersController;
  use App\Http\Controllers\ProductController;


//=============Páginas==========//

        Route::get('/', function () {
            return view('welcome');
        });


        Route::get('/Pagina_Inicial', function () {
            return view('Pagina_Inicial'); 
        });
            
        Route::get('/Navbar', function () {
            return view('Navbar'); 
        });
            
        Route::get('/CRUD_Produtos', [ProductController::class, 'index']);
        Route::get('/CRUD_Usuario', [UsersController::class, 'index']);


        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

// =====================================//




// ======== Modais das Tabelas =========//

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
// =====================================//





Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');

// ======== Modais das Tabelas PRODUTOS =========//

Route::middleware(['auth'])->group(function () {

    Route::get('/products', [ProductController::class, 'index'])->name('index');
    Route::post('/products', [ProductController::class, 'store'])->name('store');
    Route::put('/products/{product_id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/products/{product_id}', [ProductController::class, 'destroy'])->name('destroy');     
});
// =====================================//









//Login
Route::post('/login', function () {
    return 'Autenticação de Usuário';
})->name('login');




require __DIR__.'/auth.php';
