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
    <link rel="icon" type="image/png" href="{{ asset('assets/Logos/Logo Mouse Tech.png') }}">


</head>




<header>
    @include('Navbar')
</header>

<body class="bg-[#010D23] min-h-screen w-full font-sans text-white  m-0 p-0 block" >



<!-- ===== BARRA DE BUSCA COM FILTRO ===== -->

    <div class="w-full max-w-4xl mx-auto p-4 mt-4">
        <form action="{{route('produtos.buscar')}}" method="GET" class="block text-white text-xl font-bold mb-2 ml-1">
            O que procura?
        
            <div class="flex gap-3 mt-2">
                <input type="text" name="termo" value="{{request('termo')}}" placeholder="Buscar produtos..." class="flex-1 bg-white rounded-full px-6 py-2 text-black outline-none focus:ring-2 focus:ring-gray-400">
                
                <select name="product_category" class="bg-[#808080] text-white font-bold px-8 py-2 rounded-full outline-none focus:ring-2 focus:ring-gray-400 cursor-pointer"> 
                    <option value="">Filtrar por: </option>
                    <option value="computadores" {{ request('product_category') == 'Computadores' ? 'selected' : '' }}>Computadores</option>
                    <option value="domesticos" {{ request('product_category') == 'Domésticos' ? 'selected' : '' }}>Domésticos</option>
                    <option value="perifericos" {{ request('product_category') == 'Periféricos' ? 'selected' : '' }}>Periféricos</option>
                </select>
            </div>
        </form>
    </div>


<!-- ===== CASO TENHA RESULTADO ===== -->

    @if(request('termo') || request('product_category'))
        
        <h2 class="text-2xl font-bold ml-10 mt-8 mb-4 text-white">
            Resultados para: <span class="text-blue-500">"{{ request('termo') ?: request('product_category') }}"</span>
        </h2>
        
        <main class="bg-white mx-10 rounded-2xl p-8 text-black shadow-lg mb-8"> 
            <div class="grid grid-cols-2 md:grid-cols-6 gap-6 w-full">


                @forelse ($products as $produto)
                    <div class="group bg-[#e5e5e5] shadow-sm rounded-xl flex flex-col items-center p-2 h-fit border border-gray-300 hover:shadow-md transition-shadow">
                        <div class="relative w-[90%] aspect-square overflow-hidden rounded-lg border bg-white mt-2">
                            <img src="{{asset($produto->product_image)}}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300" alt="{{ $produto->product_name }}">
                        </div>
                        <div class="w-full p-2 mt-1">
                            <h2 class="text-black font-bold text-[10px] md:text-xs leading-tight line-clamp-2 min-h-[32px]">{{ $produto->product_name }}</h2>
                            <p class="text-green-900 font-extrabold mt-2 text-xs md:text-sm">R$ {{ number_format($produto->product_value, 2, ',', '.') }}</p>

                            <a href="{{route('show', $produto->product_id) }}" class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full w-full rounded-md text-center transition-colors mt-2"> 
                                COMPRAR
                            </a>

                            
                        </div>
                    </div>

<!-- ========== CASO NÃO TENHA ========= -->
                @empty
                    <div class="flex justify-center items-center col-span-full text-center text-gray-500 py-10 font-bold text-xl">
                        Nenhum produto encontrado com esse termo ou filtro. 
                        <img src="/assets/Logos/GordoTriste.jpeg" alt="Logo Mouse Tech" style="height: 150px">
                    </div>
                @endforelse
            </div>

            <div class="mt-8 flex justify-center w-full">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </main>



<!-- ========================================= -->
 <!-- =====  PÁGINA INICIAL E DESTAQUES  ===== -->       
    @else

        <section class="mb-8 w-full mt-4">
            <div class="flex items-center gap-1 mb-1">
                <h1 class="text-[20px] font-bold mt-7 ml-10">⭐Destaque</h1>
            </div>

            <div class="bg-[#d4d4d4] p-6 rounded-xl w-full">
                <div id="product-carousel" class="relative w-full" data-carousel="slide">
                    <div class="relative h-80 overflow-hidden rounded-lg">
                        @foreach ($destaques->chunk(6) as $index => $chunk)
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
                                                    <a href="{{route('show', $produto->product_id) }}" class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full w-full rounded-md text-center transition-colors mt-2"> 
                                                        COMPRAR
                                                    </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                        @for ($i=0; $i<3; $i++)
                            <button type="button" class="w-3 h-3 rounded-full transition-colors" aria-current="{{$i==0 ? 'true':'false'}}" aria-label="Slide {{$i+1}}" data-carousel-slide-to="{{$i}}"></button>
                        @endfor
                    </div>
                </div>
            </div>
        </section>

<!-- ======================================= --> 
<!-- =====  DESTAQUE DE CADA CATEGORIA ===== --> 
        <h2 class="text-2xl font-bold ml-10">Destaque de cada Categoria</h2>
        <main class="bg-[#e5e5e5] mx-10 rounded-2xl overflow-hidden pb-8 text-black shadow-lg">            



 <!-- =========== COMPUTADORES ============ -->            
           <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Computadores</h3>
                <div class="bg-[#d4d4d4] p-6 rounded-xl w-full">
                    <div id="carousel-computadores" class="relative w-full" data-carousel="slide">
                        <div class="relative h-80 overflow-hidden rounded-lg">


                            @foreach ($products->where('product_category', 'Computadores')->take(30)->chunk(6) as $index => $chunk)
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
                                                    <a href="{{route('show', $produto->product_id) }}" class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full w-full rounded-md text-center transition-colors mt-2"> 
                                                        COMPRAR
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>

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
                    </div>
                </div>
            </div>

<!-- ===========  PERIFÉRICOS  =========== --> 
            <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Periféricos</h3>
                <div class="bg-[#d4d4d4] p-6 rounded-xl w-full">
                    <div id="carousel-perifericos" class="relative w-full" data-carousel="slide">
                        <div class="relative h-80 overflow-hidden rounded-lg">

                            @foreach ($products->where('product_category', 'Periféricos')->take(30)->chunk(6) as $index => $chunk)
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
                                                    <a href="{{route('show', $produto->product_id) }}" class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full w-full rounded-md text-center transition-colors mt-2"> 
                                                        COMPRAR
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>

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
                    </div>
                </div>
            </div>


<!-- ============  DOMÉSTICOS  ============= --> 
            <div class="w-full">
                <h3 class="font-bold text-sm px-6 pt-4 pb-2">Domésticos</h3>
                <div class="bg-[#d4d4d4] p-6 rounded-xl w-full">
                    <div id="carousel-domesticos" class="relative w-full" data-carousel="slide">
                        <div class="relative h-80 overflow-hidden rounded-lg">

                            @foreach ($products->where('product_category', 'Domésticos')->take(30)->chunk(6) as $index => $chunk)
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
                                                    <a href="{{route('show', $produto->product_id) }}" class="bg-green-900 hover:bg-green-800 flex items-center justify-center text-white font-bold py-2 px-10 max-w-full w-full rounded-md text-center transition-colors mt-2"> 
                                                        COMPRAR
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>

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
                    </div>
                </div>
            </div>
        </main>

    @endif 
    </body>
</html>