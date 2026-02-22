<!DOCTYPE html>
<html lang="pt-br" class="bg-[#1a1a1a]"> 
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mouse Tech</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>


<header>
    @include('Navbar')
</header>

<body class="bg-[#1a1a1a] min-h-screen w-full font-sans text-white  m-0 p-0 block" >



    <!-- Carrosel de Destaques -->

    <section class="mb-8 w-full">

            <div class="flex items-center gap-1 mb-1">
                
                <h1 class="text-[20px] font-bold mt-7">⭐Destaque</h1>
            </div>

          
    
            <!-- Itens do carrosel -->       
               <div class="bg-[#d4d4d4] p-6 rounded-xl w-full">
                    <div id="product-carousel" class="relative w-full" data-carousel="slide">
                        
                        <div class="relative h-80 overflow-hidden rounded-lg">
                            
                            @foreach ($products->take(18)->chunk(6) as $index => $chunk)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ $index == 0 ? 'active' : '' }}">
                                    <div class="grid grid-cols-3 md:grid-cols-6 gap-4 w-full h-full px-12 py-2"> 
                                        @foreach ($chunk as $produto)
                                            <div class="group bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2 h-fit border border-gray-300 hover:shadow-md transition-shadow">
                                                <div class="relative w-[90%] aspect-square overflow-hidden rounded-lg border bg-white">
                                                    <img src="{{ asset($produto->product_image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300" alt="{{ $produto->product_name }}">
                                                </div>
                                                <div class="w-full p-2">
                                                    <h2 class="text-black font-bold text-[10px] md:text-xs leading-tight line-clamp-2 min-h-[32px]">{{ $produto->product_name }}</h2>
                                                    <p class="text-green-900 font-extrabold mt-2 text-xs md:text-sm">R$ {{ number_format($produto->product_value, 2, ',', '.') }}</p>
                                                    <button class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full rounded-md text-center transition-colors mt-1.5"> 
                                                        COMPRAR
                                                    </button>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Setas do Carrosel -->
                        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 transition-all">
                                <svg class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg>
                            </span>
                        </button>

                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 transition-all">
                                <svg class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                            </span>
                        </button>

                        <div class="absolute  z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                            @for ($i=0; $i<3; $i++)
                                <button type="button" class="w-3 h-3 rounded-full transition-colors" aria-current="{{$i==0 ? 'true':'false'}}" aria-label="Slide {{$i+1}}" data-carousel-slide-to="{{$i}}"></button>
                            @endfor
                        </div>
                        <!-------------------->

                    </div>
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



        <!-- COMPUTADORES -->
            <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Computadores</h3>
                    <div class="bg-[#d4d4d4] p-6 rounded-xl w-full">
                    <div id="product-carousel" class="relative w-full" data-carousel="slide">
                        
                        <div class="relative h-80 overflow-hidden rounded-lg">
                            
                            @foreach ($products->take(30)->chunk(6) as $index => $chunk)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ $index == 0 ? 'active' : '' }}">
                                    <div class="grid grid-cols-3 md:grid-cols-6 gap-4 w-full h-full px-12 py-2"> 
                                        @foreach ($chunk as $produto)
                                            <div class="group bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2 h-fit border border-gray-300 hover:shadow-md transition-shadow">
                                                <div class="relative w-[90%] aspect-square overflow-hidden rounded-lg border bg-white">
                                                    <img src="{{ asset($produto->product_image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300" alt="{{ $produto->product_name }}">
                                                </div>
                                                <div class="w-full p-2">
                                                    <h2 class="text-black font-bold text-[10px] md:text-xs leading-tight line-clamp-2 min-h-[32px]">{{ $produto->product_name }}</h2>
                                                    <p class="text-green-900 font-extrabold mt-2 text-xs md:text-sm">R$ {{ number_format($produto->product_value, 2, ',', '.') }}</p>
                                                    <button class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full rounded-md text-center transition-colors mt-1.5"> 
                                                        COMPRAR
                                                    </button>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Setas do Carrosel -->

                        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 transition-all">
                                <svg class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg>
                            </span>
                        </button>

                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 transition-all">
                                <svg class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                            </span>
                        </button>

                        <!-------------------->
                    </div>
                </div>
            </div>
        <!----------------------->




        <!-- PERIFÉRICOS -->
            <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Periféricos</h3>
                    <div class="bg-[#d4d4d4] p-6 rounded-xl w-full">
                    <div id="product-carousel" class="relative w-full" data-carousel="slide">
                        
                        <div class="relative h-80 overflow-hidden rounded-lg">
                            
                            @foreach ($products->take(30)->chunk(6) as $index => $chunk)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ $index == 0 ? 'active' : '' }}">
                                    <div class="grid grid-cols-3 md:grid-cols-6 gap-4 w-full h-full px-12 py-2"> 
                                        @foreach ($chunk as $produto)
                                            <div class="group bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2 h-fit border border-gray-300 hover:shadow-md transition-shadow">
                                                <div class="relative w-[90%] aspect-square overflow-hidden rounded-lg border bg-white">
                                                    <img src="{{ asset($produto->product_image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300" alt="{{ $produto->product_name }}">
                                                </div>
                                                <div class="w-full p-2">
                                                    <h2 class="text-black font-bold text-[10px] md:text-xs leading-tight line-clamp-2 min-h-[32px]">{{ $produto->product_name }}</h2>
                                                    <p class="text-green-900 font-extrabold mt-2 text-xs md:text-sm">R$ {{ number_format($produto->product_value, 2, ',', '.') }}</p>
                                                    <button class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full rounded-md text-center transition-colors mt-1.5"> 
                                                        COMPRAR
                                                    </button>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Setas do Carrosel -->

                        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 transition-all">
                                <svg class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg>
                            </span>
                        </button>

                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 transition-all">
                                <svg class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                            </span>
                        </button>

                        <!-------------------->
                    </div>
                </div>
            </div>
        <!----------------------->




        <!-- DOMÉSTICOS -->
            <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Domésticos</h3>
                    <div class="bg-[#d4d4d4] p-6 rounded-xl w-full">
                    <div id="product-carousel" class="relative w-full" data-carousel="slide">
                        
                        <div class="relative h-80 overflow-hidden rounded-lg">
                            
                            @foreach ($products->take(30)->chunk(6) as $index => $chunk)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ $index == 0 ? 'active' : '' }}">
                                    <div class="grid grid-cols-3 md:grid-cols-6 gap-4 w-full h-full px-12 py-2"> 
                                        @foreach ($chunk as $produto)
                                            <div class="group bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2 h-fit border border-gray-300 hover:shadow-md transition-shadow">
                                                <div class="relative w-[90%] aspect-square overflow-hidden rounded-lg border bg-white">
                                                    <img src="{{ asset($produto->product_image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300" alt="{{ $produto->product_name }}">
                                                </div>
                                                <div class="w-full p-2">
                                                    <h2 class="text-black font-bold text-[10px] md:text-xs leading-tight line-clamp-2 min-h-[32px]">{{ $produto->product_name }}</h2>
                                                    <p class="text-green-900 font-extrabold mt-2 text-xs md:text-sm">R$ {{ number_format($produto->product_value, 2, ',', '.') }}</p>
                                                    <button class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full rounded-md text-center transition-colors mt-1.5"> 
                                                        COMPRAR
                                                    </button>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Setas do Carrosel -->

                        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 transition-all">
                                <svg class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg>
                            </span>
                        </button>

                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 transition-all">
                                <svg class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                            </span>
                        </button>

                        <!-------------------->
                    </div>
                </div>
            </div>
        <!----------------------->



    
</body>
</html>