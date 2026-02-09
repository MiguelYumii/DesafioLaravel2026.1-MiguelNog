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









Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/users', [UsersController::class, 'index'])->name('usuarios');  //Visualizar
Route::put('/users/{user}', [UsersController::class, 'update'])->name('update'); //Editar
Route::post('/users', [UsersController::class, 'store'])->name('users.store');  //Criar 


require __DIR__.'/auth.php';
