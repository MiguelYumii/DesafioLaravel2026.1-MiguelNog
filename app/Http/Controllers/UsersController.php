<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
      
    
        $nomeimagem = 'DefaultIcon.png';
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $nomeimagem = sha1(uniqid($file->getClientOriginalName(), true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/imagemUsuario'), $nomeimagem);
        }

        $usuario = Usuario::create([
            'user_name' => $request->input('user_name'),
            'user_email' => $request->input('user_email'),
            'user_password' => Hash::make($request->user_password), // Hash = criptografia da senha
            'user_phone' => $request->input('user_phone'),
            'user_birthday' => $request->input('user_birthday'),
            'user_cpf' => $request->input('user_cpf'),
            'user_balance' => 0,
            'user_pf' => 0,
            'user_adm' => 0,
            'user_createdBy' => null,
            'foto' => $nomeimagem
        ]);


        // Endereço do viacep jogado pro banco
        if ($request->filled('endress_StreetNumber') || $request->filled('endress_cep') || $request->filled('endress_StreetExtra')) {
            $cep = $request->input('endress_cep');
            $viaCepData = null;
            if ($cep) {
                $cep = preg_replace('/[^0-9]/', '', $cep); // tirar formatação do viacepr
                $response = @file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
                if ($response !== false) {
                    $viaCepData = json_decode($response, true);
                }
            }

            Endereco::create([
                'endress_StreetNumber' => $request->input('endress_StreetNumber'),
                'endress_cep' => $cep,
                'endress_StreetExtra' => $request->input('endress_StreetExtra'),
                'usuarios_user_id' => $usuario->user_id,
                'endress_Bairro' => $viaCepData['bairro'] ?? '',
                'endress_street' => $viaCepData['logradouro'] ?? '',
                'endress_Estado' => $viaCepData['uf'] ?? '',
                'endress_City' => $viaCepData['localidade'] ?? '',
            ]);
        }

        return redirect()->route('index')->with('success', 'Usuário criado com sucesso!');
    }


    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        // parte pra deletar o endereço do usuario do banco, quando vc deleta o user
        Endereco::where('usuarios_user_id', $usuario->user_id)->delete();
        $usuario->delete();
        return redirect()->route('index')->with('success', 'Usuário deletado com sucesso!');
    }

    


    public function update(Request $request, $id) //EDITAR USUÁRIO
    {

        //TABELA DE USUARIOS
        $user = Usuario::findOrFail($id);
        $data = $request->all();
        $updateData = [
            'user_name'     => $data['user_name'] ?? $user->user_name,
            'user_email'    => $data['user_email'] ?? $user->user_email,
            'user_password' => $data['user_password'] ?? $user->user_password,
            'user_phone'    => $data['user_phone'] ?? $user->user_phone,
            'user_birthday' => $data['user_birthday'] ?? $user->user_birthday,
            'user_cpf'      => $data['user_cpf'] ?? $user->user_cpf,
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

    // ...existing code...




}