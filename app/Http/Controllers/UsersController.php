<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Endereco;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = Usuario::all();
        $enderecos = Endereco::all();
        return view('CRUD_Usuario', compact('users', 'enderecos'));
    }
}



