<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<header>   
    <nav class="relative bg-[#03223F] h-[110px]">

        <div class="flex items-center justify-between w-full h-full px-10">
            
            
            <!-- Logo do Site -->
            <a href="/Pagina_Inicial" class="h-full flex items-center py-2">
                <img src="/assets/Logos/Logo_MouseTech2.png" alt="Logo Mouse Tech" class="h-full object-contain">
            </a>
                
                <!-- Dashboard -->
                <a href="/dashboard" class="hover:text-gray-300 transition-colors">
                     <h6 class="font-bold text-white mb-0">Dashboard</h6>
                </a>

                <!-- Carrinho -->
                <a href="/" class="hover:text-gray-300 transition-colors">
                     <h6 class="font-bold text-white mb-0">Carrinho</h6>
                </a>
         
                <!-- Login -->
                <a href="/profile">
                    @auth
                    <div class="w-fit h-fit flex items-center bg-[#2b5a97] rounded-full p-1 pr-5 border border-[#3b6ba7] shadow-lg">
                        
                        <div>
                            @if(auth()->user()->userpf && !empty(auth()->user()->userpf))
                                <img src="{{auth()->user()->userpf}}" class="w-12 h-12 rounded-full border-2 border-[#4a7bb7] object-cover shadow-md">
                            @else
                                <div class="w-12 h-12 rounded-full border-2 border-[#4a7bb7] bg-blue-700 flex items-center justify-center text-white text-xl font-bold shadow-md">
                                    {{ strtoupper(substr(auth()->user()->name,0,2)) }}
                                </div>
                            @endif
                        </div>
        
                        <div class="ml-3 flex flex-col justify-center leading-tight">
                            <span class="text-white text-xl font-bold">{{ auth()->user()->name }}</span>
                            
                            @if(auth()->user()->adm == 1)
                                <span class="text-gray-300 text-[10px] uppercase tracking-[0.15em] font-medium"> Administrador </span>
                            @else
                                <span class="text-gray-300 text-[10px] uppercase tracking-[0.15em] font-medium"> Usuário </span>
                            @endif
                        </div>
                    </div>
                    @else
                    <a href="/login" class="text-white font-bold hover:text-gray-300 px-4 py-2 bg-blue-700 rounded-lg">Entrar</a>
                    @endauth
                </a>
                
            </div>
        </div>
    </nav>
</header>
</html>