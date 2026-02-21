<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mouse Tech</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#03223F] font-sans antialiased min-h-screen">

    <div class="w-full flex justify-center py-6 bg-white dark:bg-gray-800 shadow-md border-b border-gray-200 dark:border-gray-700">
        <a href="/Pagina_Inicial" class="flex justify-center items-center">
            <img src="{{asset('assets/Logos/Logo_MouseTech2.png') }}" alt="Logo Mouse Tech" class="h-[100px]">
        </a>
        <h class="text-white  text-6xl mt-5"> Mouse </h>
        <h class="text-[#16DB65] text-6xl mt-5"> Tech </h>
    </div>

    <div class="py-12 grow">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a202c] dark:bg-[#1e2330] overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-700 dark:border-gray-800">
                <div class="p-8 text-gray-100">
                    
                    <h3 class="text-2xl font-semibold mb-8 text-white text-center">Para onde deseja ir?</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        
                        <a href="{{ url('/CRUD_Usuario') }}" class="flex items-center justify-center bg-[#2563eb] hover:bg-blue-500 text-white font-bold py-12 px-4 rounded-2xl shadow-lg transition-all duration-300 hover:scale-105 text-center text-lg">
                            Tabela de Usuários
                        </a>

                        <a href="{{ url('/CRUD_Adm') }}" class="flex items-center justify-center bg-[#a855f7] hover:bg-purple-500 text-white font-bold py-12 px-4 rounded-2xl shadow-lg transition-all duration-300 hover:scale-105 text-center text-lg">
                            Tabela de Administradores
                        </a>

                        <a href="{{ url('/CRUD_Produtos') }}" class="flex items-center justify-center bg-[#059669] hover:bg-emerald-500 text-white font-bold py-12 px-4 rounded-2xl shadow-lg transition-all duration-300 hover:scale-105 text-center text-lg">
                            Tabela de Produtos
                        </a>

                        <a href="{{ url('/Pagina_Inicial') }}" class="flex items-center justify-center bg-[#059669] hover:bg-emerald-500 text-white font-bold py-12 px-4 rounded-2xl shadow-lg transition-all duration-300 hover:scale-105 text-center text-lg">
                            Página Inicial
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>