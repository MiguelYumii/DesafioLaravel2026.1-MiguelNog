<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Endereco;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()  //função pra visualizar os user
    {
        $users = Usuario::all();
        $enderecos = Endereco::all();
        return view('CRUD_Usuario', compact('users', 'enderecos')); //compact transforma em vetor pra poder enviar

    }

    public function create() //função pra criar o user
    {
        return view('create_user');
    }


    
    public function update(Request $request, $id) //EDITAR USUÁRIO
    {

        //TABELA DE USUARIOS
        $user = Usuario::findOrFail($id);
        $data = $request->all();
        $updateData = [
            'user_name'     => $data['user_name'] ?? $user->user_name,
            'user_email'    => $data['email'] ?? $user->user_email,
            'user_password' => $data['senha'] ?? $user->user_password,
            'user_phone'    => $data['telefone'] ?? $user->user_phone,
            'user_birthday' => $data['datanascimento'] ?? $user->user_birthday,
            'user_cpf'      => $data['cpf'] ?? $user->user_cpf,
            'user_balance'  => $user->user_balance,
            'user_pf'       => $user->user_pf,
            'user_adm'      => $user->user_adm,
        ];
        $user->update($updateData);



        //TABELA DE ENDEREÇO
        $endereco = Endereco::where('usuarios_user_id', $user->user_id)->first();
       
            $enderecoData = [
                'endress_StreetNumber' => $data['numerocasa']  ?? $endereco->endress_StreetNumber,
                'endress_cep'          => $data['cep']         ?? $endereco->endress_cep,
                'endress_StreetExtra'  => $data['complemento'] ?? $endereco->endress_StreetExtra,
            ];
            $endereco->update($enderecoData);
        
        return redirect()->route('index');

    }

     public function store(Request $request, $id) //EDITAR USUÁRIO
    {


}




}