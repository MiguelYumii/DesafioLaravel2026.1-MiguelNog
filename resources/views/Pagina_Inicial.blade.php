<!DOCTYPE html>
<html lang="pt-br" class="bg-[#1a1a1a]"> 
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mouse Tech</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>


<header>
    @include('Navbar')
</header>

<body class="bg-[#1a1a1a] min-h-screen w-full font-sans text-white  m-0 p-0 block" >



    <!-- Carrosel de Destaques -->

    <section class="mb-8 w-full">

            <div class="flex items-center gap-1 mb-1">
                
                <h1 class="text-[20px] font-bold mt-7">⭐Mais Comprados</h1>
            </div>

          
    
            <!-- Itens do carrosel -->       
                <div class="bg-[#d4d4d4] p-4 rounded-md w-full">
                    <div id="indicators-carousel" class="relative w-full" data-carousel="static">
                        <div class="relative h-80 overflow-hidden flex gap-4 overflow-x-auto snap-x scrollbar-hide">
            
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            
                                            
                                <!-- Container dos Produtos-->
                                <div class="grid grid-cols-3 md:grid-cols-6 gap-4"> 
    
                                    @foreach ($products as $produto)
                                        <div class="bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2">
                                            
                                            <img src="{{ asset($produto->product_image) }}" class="w-[90%] rounded-xl border mt-1 aspect-square object-cover" alt="Imagem do produto">
                                            
                                            <div class="w-full p-2">
                                                <h2 class="text-black font-bold text-2xs md:text-xs leading-tight line-clamp-2">{{ $produto->product_name }}</h2>
                                                <h2 class="text-green-900 font-bold mt-2 text-xs md:text-sm">R$ {{ number_format($produto->product_value, 2, ',', '.') }}</h2>

                                                <button class="bg-green-900 hover:bg-green-800  flex items-center justify-center text-white font-bold py-2 px-10 max-w-full rounded-md transition-colors mt-1.5"> COMPRAR</button>
                                            </div>
                                            
                                        </div>
                                    @endforeach

                                </div>
                                <!-------------------------->
                                
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        </div>
                    </div>
                </div>
            
                <!-- Bolinha da Paginação-->
                    <div class="absolute z-30 top-77 flex -translate-x-1/2 space-x-3 bottom-5 left-1/2">
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    </div>
                <!------------------------->
            
                 <!------Setas Laterais----->
                    <div>
                            <button type="button" class="absolute top-39 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 group-hover:bg-black/50">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </span>
                            </button>

                            <button type="button" class="absolute top-39 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 group-hover:bg-black/50">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </button>
                    </div>
                <!------------------------->

    

    </section>

    <!--------------------------->

        <div class="w-full max-w-4xl mx-auto p-4">

            <h3 class="block text-white text-xl font-bold mb-2 ml-1">
                O que procura?
            </h3>
        
            <div class="flex gap-3">
                <input type="text" placeholder="Buscar produtos..." class="flex-1 bg-white rounded-full px-6 py-2 text-black outline-none focus:ring-2 focus:ring-gray-400">
                <button class="bg-[#808080] hover:bg-gray-600 text-white font-bold px-8 py-2 rounded-full transition-colors"> FILTRO </button>
            </div>

        </div>



        

        <h2 class="text-2xl font-bold ml-10">Mais Vendidos de cada Categoria</h2>

        <main class="bg-[#e5e5e5] mx-10 rounded-2xl overflow-hidden pb-8 text-black shadow-lg">            

            <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Computadores</h3>
                <div class="bg-[#d4d4d4] p-4 w-full grid grid-cols-4 md:grid-cols-8 gap-3">
                
                        <div class="bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2">
                            <img src="/assets/Logos/UserPF.png" class="w-[90%] rounded-xl border mt-1 aspect-square object-cover">
                            <div class="w-full p-2">
                                    <h2 class="text-black font-bold text-[10px] md:text-xs leading-tight line-clamp-2">Fursuit Mariposa</h2>
                                    <h2 class="text-green-900 font-bold mt-2 text-xs md:text-sm">R$: 50,00</h2>

                                    <button class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full rounded-md text-center transition-colors mt-1.5"> COMPRAR</button>
                            </div>
                        </div>

                </div>
            </div>



            <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Periféricos</h3>
                <div class="bg-[#d4d4d4] p-4 w-full grid grid-cols-4 md:grid-cols-8 gap-3">
                
                        <div class="bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2">
                            <img src="/assets/Logos/UserPF.png" class="w-[90%] rounded-xl border mt-1 aspect-square object-cover">
                            <div class="w-full p-2">
                                <h2 class="text-black font-bold text-[10px] md:text-xs leading-tight line-clamp-2">Fursuit Mariposa</h2>
                                <h2 class="text-green-900 font-bold mt-2 text-xs md:text-sm">R$:50,00</h2>

                            <button class="bg-green-900 hover:bg-green-800  flex items-center justify-center text-white font-bold py-2 px-10 max-w-full rounded-md transition-colors mt-1.5"> COMPRAR</button>
                            </div>
                        </div>

                </div>




            <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Domésticos</h3>
                <div class="bg-[#d4d4d4] p-4 w-full grid grid-cols-4 md:grid-cols-8 gap-3">

                        <div class="bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2">
                            <img src="/assets/Logos/UserPF.png" class="w-[90%] rounded-xl border mt-1 aspect-square object-cover">
                            <div class="w-full p-2">
                                <h2 class="text-black font-bold text-[10px] md:text-xs leading-tight line-clamp-2">Fursuit Mariposa</h2>
                                <h2 class="text-green-900 font-bold mt-2 text-xs md:text-sm">R$:50,00</h2>

                            <button class="bg-green-900 hover:bg-green-800  flex items-center justify-center text-white font-bold py-2 px-10 max-w-full rounded-md transition-colors mt-1.5"> COMPRAR</button>
                        </div>


                </div>
            </div>




    
</body>
</html>