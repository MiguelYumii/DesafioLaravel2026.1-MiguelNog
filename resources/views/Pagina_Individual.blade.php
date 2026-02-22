<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produto->product_name ?? 'Visualizar Produto' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{asset('assets/Logos/Logo Mouse Tech.png')}}">
</head>


<header>
         @include('Navbar')
</header>




<body class="bg-[#010D23] text-gray-800 font-sans min-h-screen flex flex-col relative">

    <main class="flex-grow container mx-auto px-4 py-8 flex items-center justify-center">
        <div class="bg-white w-full max-w-5xl rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            
            
            <!-- ===== Lado Esquerdo ===== -->
            <div class="md:w-1/2 bg-[#021831] p-8 flex items-center justify-center relative">
                <span class="absolute top-4 left-4 bg-gray-800 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow">
                    {{ $produto->product_category ?? 'Categoria' }}
                </span>
                
                <div class="w-full aspect-square bg-white rounded-xl shadow-inner border border-gray-300 flex items-center justify-center overflow-hidden">
                    <img src="{{asset($produto->product_image)}}" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- ======================== -->



            <!-- ===== Lado Direito ===== -->


            <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-between bg-[#03223F]">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight mb-4"> {{$produto->product_name}}</h1>
                    
                     <!-- preço -->
                    <p class="text-4xl font-black text-green-500 mb-6">
                        R$ {{ number_format($produto->product_value ?? 0, 2, ',', '.') }}
                    </p>

                     <!-- estoque -->
                    <div class="inline-flex items-center bg-[#021831] text-white px-3 py-1 rounded-md text-sm font-semibold mb-6">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Estoque: {{ $produto->product_stock ?? 0 }} disponíveis
                    </div>


                    <!-- descrição -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-2 border-b border-gray-300 pb-1">Descrição</h3>
                        <p class="text-white leading-relaxed text-sm text-justify">{{ $produto->product_description}}</p>
                    </div>
                </div>


            <!-- ===== INFORMAÇÕES DO AUTOR ===== -->  
                <div>
                    <div class="bg-[#021831] text-white p-4 rounded-xl shadow-sm mb-6">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Informações do Vendedor</h3>
                        <div class="flex flex-col gap-2">
                            <p class="font-semibold flex items-center">
                                <span class="text-xl mr-2">Autor: </span> {{ $produto->product_autor ?? 'Nome não informado' }}
                            </p>
                            <p class="font-semibold flex items-center">
                                <span class="text-xl mr-2">Telefone: </span> {{ $produto->product_AutorPhone ?? '(00) 00000-0000' }}
                            </p>
                        </div>
                    </div>


        <!-- ================================ -->



        
                        
        
        <!-- ===== BOTÃO DE COMPRA ===== -->
                    @auth
                        @if(auth()->user()->is_admin)
                            <button disabled class="w-full bg-gray-400 text-white font-bold py-4 px-6 rounded-xl cursor-not-allowed shadow-sm text-lg flex justify-center items-center gap-2 opacity-70">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                SEM ACESSO
                            </button>
                        @else

                            <!-- BLOCK caso acabe o estoque -->
                                @if($produto->product_stock > 0)
                                    <label for="modalCompraToggle" type="button" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full flex justify-center items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        COMPRAR AGORA
                                    </label>
                                @else
                                    <button type="button" disabled class="bg-gray-500 text-gray-300 font-bold py-2 px-4 rounded w-full flex justify-center items-center gap-2 cursor-not-allowed opacity-75">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        PRODUTO INDISPONÍVEL
                                    </button>
                                @endif   
                            <!-- ========================= -->
                        @endif
                    @else
                    
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded relative text-center" role="alert">
                            <p class="font-bold mb-2">Você precisa estar logado para comprar.</p>
                            <a href="/login" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                Fazer Login
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </main>







<!-- MODAL de COMPRAR -->
    <input type="checkbox" id="modalCompraToggle" class="peer hidden">
    <div class="fixed inset-0 z-50 hidden peer-checked:flex items-center justify-center">
        <label for="modalCompraToggle" class="absolute inset-0 bg-black bg-opacity-80 cursor-pointer"></label>
        
        <div class="relative bg-slate-900 p-8 rounded-xl border border-slate-800 w-full max-w-sm shadow-2xl z-10">
            <h2 class="text-white text-xl font-bold mb-6">Confirmar Compra</h2>
            
            <div class="bg-slate-800 p-4 rounded-lg mb-6">
                <div class="flex justify-between mb-2">
                    <span class="text-slate-400 text-sm">Seu Saldo:</span>
                    <span class="text-green-400 font-bold text-sm">R$ {{ number_format(auth()->user()->balance ?? 0, 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 text-sm">Preço Unitário:</span>
                    <span class="text-white font-bold text-sm">R$ {{ number_format($produto->product_value ?? 0, 2, ',', '.') }}</span>
                </div>
            </div>

            <form action="{{route('produto.comprar',$produto->product_id)}}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="text-slate-400 text-xs block mb-2 uppercase tracking-widest">Quantidade</label>
                    <input type="number" name="quantidade" id="qtdInput" value="1" min="1" 
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <div class="flex justify-between items-end mb-8">
                    <span class="text-slate-400">Total a pagar:</span>
                    <span id="displayTotal" class="text-3xl font-black text-white">R$ {{ number_format($produto->product_value ?? 0, 2, ',', '.') }}</span>
                </div>

                <div class="flex gap-4">
                    <label for="modalCompraToggle" class="flex-1 text-center py-3 text-slate-400 hover:text-white transition cursor-pointer">
                        Cancelar
                    </label>
                    <button type="submit" class="flex-2 bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg shadow-green-900/20">
                        CONFIRMAR
                    </button>
                </div>
            </form>
        </div>
    </div>













    <!-- JS da calculadora do produto e formatação do código -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputQtd = document.getElementById('qtdInput');
            const displayTotal = document.getElementById('displayTotal');
            const precoUnitario = {{ $produto->product_value ?? 0 }};

            if (inputQtd && displayTotal) {
                inputQtd.addEventListener('input', function(e) {
                    const quantidade = e.target.value > 0 ? e.target.value : 1;
                    const total = quantidade * precoUnitario;
                    
                    displayTotal.innerText = 'R$ ' + total.toLocaleString('pt-BR', { 
                        minimumFractionDigits: 2, 
                        maximumFractionDigits: 2 
                    });
                });
            }
        });
    </script>


</body>
</html>