<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
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

    public function store(Request $request)
{
   
     Usuario::create([
            'user_name'=> $request->user_name,
            'user_email'=> $request->user_email,
            'user_password'=> Hash::make($request->user_password), //hash ele criptografa a senha
            'user_phone'=> $request->user_phone,
            'user_cpf'=> $request->user_cpf,
            'user_birthdate'=> $request->user_birthdate,
            'user_pf'=> $request->user_pf,

        ]);

        return redirect()->back();
   }

    public function update(Usuario $user, Request $request)
    {
        $data = $request->all();
        $user->update($data);
        $user->save();
    
    
        return redirect()->route('index');
    
    }
 


    public function destroy(Usuario $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Usuário deletado com sucesso!');
    }


}
