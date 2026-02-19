<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Endereco;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


public function store(Request $request): RedirectResponse
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


                event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));


    }
}