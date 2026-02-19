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


<section class="bg-[#16436d] ">

    <div class="grid-cols-2 gap-20 min-h-screen flex items-center justify-center bg-[#010D23] py-12 px-4 sm:px-6 lg:px-8">

        <!-- Logo do site -->
        <div class="text-center mb-8">
            <p class="text-white text-5xl font-bold">Bem-Vindo de Volta!</p>
            <img src="{{ asset('assets\Logos\Logo Mouse Tech 2.png') }}" class="w-130 h-130 object-contain" alt="Mouse Tech Logo">
        </div>

        <div class="max-w-md w-full space-y-8 bg-slate-800 p-8 rounded-2xl shadow-xl">
               <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Manter sessão') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif

            <button type="submit" class="ms-3 bg-[#0EB454] text-white hover:bg-[#058C42] font-bold py-2 px-6 rounded shadow uppercase text-xs tracking-widest transition ease-in-out duration-150">
                {{ __('Entrar') }}
            </button>
        </div>
    </form>
        </div>
    </div>





</section>