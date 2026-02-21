<!DOCTYPE html>
<html lang="pt-br"> 
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mouse Tech</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>


<section>

    <div class="grid-cols-2 gap-20 min-h-screen flex items-center justify-center bg-[#010D23] py-12 px-4 sm:px-6 lg:px-8">

        <!-- Logo do site -->
        <div class="text-center mb-8">
            <p class="text-white text-5xl font-bold">Seja Bem-Vindo!</p>
            <img src="{{ asset('assets\Logos\Logo_MouseTech2.png') }}" class="w-130 h-130 object-contain" alt="Mouse Tech Logo">
        </div>

        <div class="max-w-md w-full space-y-8 bg-slate-800 p-8 rounded-2xl shadow-xl">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="user_name" :value="__('Nome')" class="text-white" />
                    <x-text-input id="user_name" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2" type="text" name="user_name" :value="old('user_name')" required autofocus autocomplete="user_name" />
                    <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="user_email" :value="__('Email')" class="text-white" />
                    <x-text-input id="user_email" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2" type="email" name="user_email" :value="old('user_email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="user_password" :value="__('Senha')" class="text-white" />
                    <x-text-input id="user_password" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2"
                                    type="password"
                                    name="user_password"
                                    required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="text-white" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="endress_cep" :value="__('Cep')" class="text-white" />
                    <x-text-input id="endress_cep" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2" type="text" name="endress_cep" :value="old('endress_cep')" required autocomplete="endress_cep" />
                    <x-input-error :messages="$errors->get('endress_cep')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="endress_StreetExtra" :value="__('Complemento')" class="text-white" />
                    <x-text-input id="endress_StreetExtra" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2" type="text" name="endress_StreetExtra" :value="old('endress_StreetExtra')" required autofocus autocomplete="endress_StreetExtra" />
                    <x-input-error :messages="$errors->get('endress_StreetExtra')" class="mt-2" />
                </div>      
                    
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <x-input-label for="user_phone" :value="__('Telefone')" class="text-white" />
                        <x-text-input id="user_phone" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2" type="text" name="user_phone" :value="old('user_phone')" required autofocus autocomplete="user_phone" />
                        <x-input-error :messages="$errors->get('user_phone')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="user_cpf" :value="__('CPF')" class="text-white" />
                        <x-text-input id="user_cpf" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2" type="text" name="user_cpf" :value="old('user_cpf')" required autofocus autocomplete="user_cpf" />
                        <x-input-error :messages="$errors->get('user_cpf')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="endress_StreetNumber" :value="__('Número de Residência')" class="text-white" />
                        <x-text-input id="endress_StreetNumber" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2" type="text" name="endress_StreetNumber" :value="old('endress_StreetNumber')" required autofocus autocomplete="endress_StreetNumber" />
                        <x-input-error :messages="$errors->get('endress_StreetNumber')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="user_birthday" :value="__('Data de Nascimento')" class="text-white" />
                        <x-text-input id="user_birthday" class="block mt-1 w-full bg-slate-950 border-none text-white focus:ring-2 focus:ring-blue-500 rounded-lg pl-3 py-2" type="date" name="user_birthday" :value="old('user_birthday')" required autofocus autocomplete="user_birthday" />
                        <x-input-error :messages="$errors->get('user_birthday')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a class="underline text-sm text-gray-400 hover:text-white" href="{{ route('login') }}">
                        {{ __('Já possui uma conta?') }}
                    </a>

                    <button type="submit" class="bg-[#0EB454] text-white hover:bg-[#058C42] font-bold py-2 px-6 rounded shadow uppercase text-xs tracking-widest transition ease-in-out duration-150">
                        {{ __('Cadastrar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>





</section>