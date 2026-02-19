<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth; 

class UsersController extends Controller
{
    public function index()  
    {
        $users = User::all();
        $users = \App\Models\User::paginate(50);
        $enderecos = Endereco::all();
        return view('CRUD_Usuario', compact('users', 'enderecos')); 
    }
    

    //criar
    public function store(Request $request)
    {
        $user_pf = '';

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $nomeimagem = sha1(uniqid($file->getClientOriginalName(), true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/UsuarioPF'), $nomeimagem);
            $user_pf = 'assets/UsuarioPF/' . $nomeimagem;
        }

        // forcecreate por conta do erro do adm, resolver isso depois na integração
        $user = User::forceCreate([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            'password' => Hash::make($request->input('user_password')),
            'phone' => $request->input('user_phone'),
            'birthday' => $request->input('user_birthday'),
            'cpf' => $request->input('user_cpf'),
            'balance' => 0,
            'userpf' => $user_pf,
            'adm' => 0,
            
            ]); 



        if ($request->filled('endress_StreetNumber') || $request->filled('endress_cep') || $request->filled('endress_StreetExtra')) {
            $cep = $request->input('endress_cep');
            $viaCepData = [];

            if ($cep) {
                $cep = preg_replace('/[^0-9]/', '', $cep);
                $response = @file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
                if ($response !== false) {
                    $viaCepData = json_decode($response, true);
                }
            }

            Endereco::create([
                'endress_StreetNumber' => $request->input('endress_StreetNumber'),
                'endress_cep' => $cep,
                'endress_StreetExtra' => $request->input('endress_StreetExtra'),
                'usuarios_user_id' => $user->id, 
                'endress_Bairro' => $viaCepData['bairro'] ?? '',
                'endress_street' => $viaCepData['logradouro'] ?? '',
                'endress_Estado' => $viaCepData['uf'] ?? '',
                'endress_City' => $viaCepData['localidade'] ?? '',
            ]);
        }

        return redirect()->route('index')->with('success', 'Usuário criado com sucesso!');
    }


    //apagar
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Endereco::where('usuarios_user_id', $user->id)->delete();
        $user->delete();
        
        if($user->userpf && File::exists(public_path($user->userpf))) {
             File::delete(public_path($user->userpf)); 
        }

        return redirect()->route('index')->with('success', 'Usuário deletado com sucesso!');
    }



    //editar
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();

        


        $updateData = [
            'name'     => $data['user_name'] ?? $user->name,
            'email'    => $data['user_email'] ?? $user->email,
            'phone'    => $data['user_phone'] ?? $user->phone,
            'birthday' => $data['user_birthday'] ?? $user->birthday,
            'cpf'      => $data['user_cpf'] ?? $user->cpf,
        ];

        if (!empty($data['user_password'])) {
            $updateData['password'] = Hash::make($data['user_password']);
        }

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            if($user->userpf && File::exists(public_path($user->userpf))) {
                File::delete(public_path($user->userpf)); 
            }

            $file = $request->file('foto');
            $nomeimagem = sha1(uniqid($file->getClientOriginalName(), true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/UsuarioPF'), $nomeimagem);
            $updateData['userpf'] = 'assets/UsuarioPF/' . $nomeimagem;
        }
        
        $user->forceFill($updateData)->save();

        $endereco = Endereco::where('usuarios_user_id', $user->id)->first();
        if ($endereco) {
            $enderecoData = [
                'endress_StreetNumber' => $data['endress_StreetNumber'] ?? $endereco->endress_StreetNumber,
                'endress_cep'          => $data['endress_cep']          ?? $endereco->endress_cep,
                'endress_StreetExtra'  => $data['endress_StreetExtra']  ?? $endereco->endress_StreetExtra,
            ];

            if (!empty($data['endress_cep'])) {
                $cep = preg_replace('/[^0-9]/', '', $data['endress_cep']);
                $response = @file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
                if ($response !== false) {
                    $viaCepData = json_decode($response, true);
                    if (!isset($viaCepData['erro'])) {
                        $enderecoData['endress_Bairro'] = $viaCepData['bairro'] ?? $endereco->endress_Bairro;
                        $enderecoData['endress_street'] = $viaCepData['logradouro'] ?? $endereco->endress_street;
                        $enderecoData['endress_Estado'] = $viaCepData['uf'] ?? $endereco->endress_Estado;
                        $enderecoData['endress_City'] = $viaCepData['localidade'] ?? $endereco->endress_City;
                    }
                }
            }

            $endereco->forceFill($enderecoData)->save();
        }
        
        return redirect()->route('index');
    }
}