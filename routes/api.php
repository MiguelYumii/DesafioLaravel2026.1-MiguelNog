<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CepController;

Route::get('showUser', [UserController::class, 'showUser']);
Route::get('showAdmin', [AdminController::class, 'showAdmin']);
Route::get('showProduct', [ProductController::class, 'showProduct']);
Route::get('cep/{cep}', [CepController::class, 'show']);