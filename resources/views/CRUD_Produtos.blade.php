<!DOCTYPE html>
<html lang="pt-br" class="bg-[#1a1a1a]"> 
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mouse Tech</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="{{asset('assets/Logos/Logo Mouse Tech.png')}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>


<header>
    @include('Navbar')
</header>



<body class="bg-[#031221] min-h-screen w-full font-sans text-white m-0 p-0 block">

    <!-- Header -->
    <div class="max-w-7xl mx-auto mt-10">
        
        <!--Botão de CRIAR -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 bg-slate-800 p-4 rounded-lg border border-slate-700 shadow-md">
            <h2 class="text-xl font-bold text-white">Gerenciamento de Produtos</h2>
            
            @if(auth()->check()) 
            <button type="button" data-modal-target="criar-modal" data-modal-toggle="criar-modal" class="bg-[#058C42] hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-medium flex items-center justify-center transition-colors shadow-sm">
                + Criar Produto
            </button>
            @endif

        </div>

        <!-- ============= -->


        <!-- Tabela do COMPUTADOR -->

        <div class="hidden lg:block relative overflow-x-auto bg-slate-800 shadow-xs rounded-lg border border-slate-700">
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-white text-center bg-slate-900 border-b border-slate-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium"> ID</th>
                        <th scope="col" class="px-6 py-3 font-medium"> Foto </th>
                        <th scope="col" class="px-6 py-3 font-medium"> Nome </th>
                        <th scope="col" class="px-6 py-3 font-medium"> Categoria </th>
                        <th scope="col" class="px-6 py-3 font-medium"> ID do Autor </th>
                        <th scope="col" class="px-6 py-3 font-medium"> Ações </th>
                    </tr>
                </thead>

        <!-- ------------------ -->
                <tbody>
                    @foreach ($products as $produto)

                    <tr class="bg-slate-800 even:bg-[#03223F] border-b border-slate-700 text-center hover:bg-slate-700/50 transition-colors">
                        <th class="text-white px-6 py-4" > {{$produto->product_id}} </th>

                        <td class="text-white px-6 py-4">
                            @if($produto->product_image && !empty($produto->product_image))
                                <img src="{{$produto->product_image}}" class="block mx-auto w-14 h-14 rounded-2xl border-2 border-[#4a7bb7] object-cover">
                            @else
                                <div class="mx-auto w-14 h-14 rounded-2xl object-cover border-2 border-[#4a7bb7] bg-blue-700 flex items-center justify-center text-white text-xl font-bold">
                                    {{ strtoupper(substr($produto->product_name,0,2)) }}
                                </div>
                            @endif
                        </td>

                        <td class="text-white px-6 py-4 text-center"> {{$produto->product_name}} </td>
                        <td class="text-white px-6 py-4 text-center"> {{$produto->product_category}} </td>
                        <td class="text-white px-6 py-4 text-center"> {{$produto->product_autor}} </td>
                        <td class="px-6 py-4">

                            <div class="text-white flex items-center justify-center gap-5">
                            @if(auth()->check() && auth()->user()->id == $produto->product_autor)
                                <button data-modal-target="ver-modal-{{$produto->product_id}}" data-modal-toggle="ver-modal-{{$produto->product_id}}" class="font-medium text-[#058C42] hover:text-green-400 hover:underline">Ver</button>
                                <button data-modal-target="editar-modal-{{$produto->product_id}}" data-modal-toggle="editar-modal-{{$produto->product_id}}" class="font-medium text-[#f2ff38] hover:text-yellow-300 hover:underline">Editar</button>
                                <button data-modal-target="popup-modal-{{$produto->product_id}}" data-modal-toggle="popup-modal-{{$produto->product_id}}" class="font-medium text-[#bd0f0f] hover:text-red-400 hover:underline">Excluir</button>
                            @else
                                <span class="text-gray-500 italic">Sem Acesso</span>
                             @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        <!-- =================== -->

        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:hidden">
            @foreach ($products as $produto)
            <div class="bg-slate-800 rounded-xl shadow-lg border border-slate-700 p-5 flex flex-col items-center relative w-full max-w-md mx-auto hover:border-[#4a7bb7] transition-colors">
                
                <span class="absolute top-3 left-3 bg-slate-900 text-gray-400 text-xs font-bold px-2 py-1 rounded">
                    ID: {{$produto->id}}
                </span>

                <div class="mt-4 mb-3">
                    @if($produto->product_image && !empty($produto->product_image))
                        <img src="{{$produto->product_image}}" class="w-20 h-20 rounded-2xl border-2 border-[#4a7bb7] object-cover shadow-md">
                    @else
                        <div class="w-20 h-20 rounded-full border-2 border-[#4a7bb7] bg-blue-700 flex items-center justify-center text-white text-2xl font-bold shadow-md">
                            {{ strtoupper(substr($produto->product_name,0,2)) }}
                        </div>
                    @endif
                </div>

                <h3 class="text-lg font-semibold text-white text-center w-full truncate px-2" title="{{$produto->product_name}}">
                    {{$produto->product_name}}
                </h3>
                <p class="text-sm text-gray-400 text-center w-full truncate mb-3" title="{{$produto->product_description}}">
                    {{$produto->product_description}}
                </p>

                <div class="mb-5">
                    @if($produto->adm == 1)  
                        <span class="bg-green-900/30 text-green-500 border border-green-800 text-xs px-3 py-1 rounded-full font-medium">Administrador</span>
                    @else
                        <span class="bg-slate-700 text-gray-300 border border-slate-600 text-xs px-3 py-1 rounded-full font-medium">Usuário</span>
                    @endif
                </div>

                <div class="mt-auto w-full pt-4 border-t border-slate-700/80">
                    <div class="flex items-center justify-center gap-4">
                            <button data-modal-target="ver-modal-{{$produto->product_id}}" data-modal-toggle="ver-modal-{{$produto->product_id}}" class="font-medium text-[#058C42] hover:text-green-400 hover:underline transition-colors">Ver</button>
                            <button data-modal-target="editar-modal-{{$produto->product_id}}" data-modal-toggle="editar-modal-{{$produto->product_id}}" class="font-medium text-[#f2ff38] hover:text-yellow-300 hover:underline transition-colors">Editar</button>
                            <button data-modal-target="popup-modal-{{$produto->product_id}}" data-modal-toggle="popup-modal-{{$produto->product_id}}" class="font-medium text-[#bd0f0f] hover:text-red-400 hover:underline transition-colors">Excluir</button>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        <div class="mt-6 py-4 bg-slate-900 rounded-lg shadow-sm border border-slate-700 px-4 overflow-x-auto">
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>








    <!-- MODAL DE VISUALIZAR -->
    @foreach ($products as $produto)   
    <div id="ver-modal-{{$produto->product_id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-slate-700 border border-default rounded-base shadow-sm p-4 md:p-6">
                
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-white">
                        Informações do Produto
                    </h3>
                </div>
                
                <img src="{{$produto->product_image}}" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7] object-cover">

                <div class="mb-4">
                    <div>
                        <label class="block mb-2.5 text-sm font-medium text-white">Nome</label>
                        <div class="bg-slate-600 border border-default-medium text-white text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                            {{$produto->product_name}}
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2.5 text-sm font-medium text-white">Descrição</label>
                        <div class="bg-slate-600 border border-default-medium text-white text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                            {{$produto->product_description}}
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2.5 text-sm font-medium text-white">Categoria</label>
                        <div class="bg-slate-600 border border-default-medium text-white text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                            {{$produto->product_category}}
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2.5 text-sm font-medium text-white">Estoque</label>
                        <div class="bg-slate-600 border border-default-medium text-white text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                            {{$produto->product_stock}}
                        </div>
                    </div>
                    
                    <div>
                        <label class="block mb-2.5 text-sm font-medium text-white">Preço</label>
                        <div class="bg-slate-600 border border-default-medium text-white text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                            R$ {{$produto->product_value}}
                        </div>
                    </div> 



                    <div>
                        <label class="block mb-2.5 text-sm font-medium text-white">Autor</label>
                        <div class="bg-slate-600 border border-default-medium text-white text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                            {{$produto->product_autor}}
                        </div>
                    </div> 
                </div>

                <div class="flex items-center justify-end space-x-4 border-t border-default pt-4 md:pt-6">
                    <button data-modal-hide="ver-modal-{{$produto->product_id}}" type="button" class="text-white bg-slate-800  box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-6 py-2.5 focus:outline-none transition-all">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- MODAL DE EXCLUIR -->
    <div id="popup-modal-{{$produto->product_id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-slate-700 border border-default rounded-base shadow-sm p-4 md:p-6">
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-fg-disabled w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <h3 class="mb-6 text-white">Tem certeza que deseja excluir este produto? Está ação é irreversível</h3>
                    
                    <form action="{{ route('destroy', $produto->product_id) }}" method="POST" class="flex items-center space-x-4 justify-center">    
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-white bg-red-600 box-border border border-transparent hover:bg-red-700 focus:ring-4 focus:ring-red-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                            Tenho certeza
                        </button>
                        <button data-modal-hide="popup-modal-{{$produto->product_id}}" type="button" class="text-white bg-slate-800 box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                            Não
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>







<!-- MODAL DE EDITAR -->

    <div id="editar-modal-{{$produto->product_id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-slate-700 border border-default rounded-base shadow-sm p-4 md:p-6">
                
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-white">
                        Editar Produto
                    </h3>
                </div>
                
                <form action="{{route('update', $produto->product_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <img id="preview-edit-{{$produto->product_id}}" src="{{$produto->foto ?: '/assets/ProdutoPF/UPF.png'}}" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7] object-cover">
                    <div class="col-span-2 flex flex-col items-center mb-2">
                        <label for="foto-edit-{{$produto->product_id}}" class="cursor-pointer text-blue-400 hover:underline">Selecionar foto de perfil</label>
                        <input type="file" name="foto" id="foto-edit-{{$produto->product_id}}" accept="image/*" class="hidden" onchange="if(this.files[0]) document.getElementById('preview-edit-{{$produto->product_id}}').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    
                    <div>
                        <div>
                            <label for="produto_name" class="block mb-2.5 text-sm font-medium text-white">Nome</label>
                            <input type="text" name="produto_name" id="produto_name" value="{{$produto->product_name}}" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </div>

                        <div>
                            <label for="produto_descricao" class="block mb-2.5 text-sm font-medium text-white">Descrição</label>
                            <input type="text" name="produto_descricao" id="produto_descricao" value="{{$produto->product_description}}" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </div>
                    
                        <div>
                            <label for="produto_categoria" class="block mb-2.5 text-sm font-medium text-white">Categoria</label>
                            <input type="text" name="produto_categoria" id="produto_categoria" value="{{$produto->product_category}}" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </div>

                        <div>
                            <label for="produto_preco" class="block mb-2.5 text-sm font-medium text-white">Preço</label>
                            <input type="number" name="produto_preco" id="produto_preco" value="{{$produto->product_value}}" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </div>


                        <div>
                            <label for="produto_estoque" class="block mb-2.5 text-sm font-medium text-white">Estoque</label>
                            <input type="text" name="produto_estoque" id="produto_estoque" value="{{$produto->product_stock}}" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </div>

                        
                        

                    </div>

                    <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6 col-span-2 mt-4">
                        <button type="submit" class="inline-flex items-center  text-white bg-[#0EB454] hover:bg-[#058C42]  box-border border border-transparent focus:ring-4 focus:ring-green-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                            <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                            Confirmar alterações
                        </button>
                        <button data-modal-hide="editar-modal-{{$produto->product_id}}" type="button" class="text-white bg-slate-800 box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div> 
    @endforeach










<!-- MODAL DE CRIAR -->
<div id="criar-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-slate-700 border border-[#4a7bb7] rounded-base shadow-sm p-4 md:p-6">
                
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-white">
                        Criar Produto
                    </h3>
                </div>

                <form action="/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <img id="preview-create" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7] object-cover"
                        src="/assets/UsuarioPF/UPF.png" alt="Foto do Produto">

                    <div class="flex flex-col items-center mb-2">
                        <label for="foto-create" class="cursor-pointer text-blue-400 hover:underline">Selecionar foto do Produto</label>
                        <input type="file" name="foto" id="foto-create" accept="image/*" class="hidden" required>
                    </div>

                    <div>
                        <label for="nome" class="block mt-2.5 text-sm font-medium text-white">Nome</label>
                        <input type="text" name="Produto_Nome" id="Produto_Nome" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" required>
                    </div>

                    <div>
                        <label for="descricao" class="block mt-2.5 text-sm font-medium text-white">Descrição</label>
                        <input type="text" name="Produto_Descricao" id="Produto_Descricao" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>

                    <div>
                        <label for="categoria" class="block mt-2.5 text-sm font-medium text-white">Categoria</label>
                        <input type="text" name="Produto_Categoria" id="Produto_Categoria" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>

                    <div>
                        <label for="preco" class="block mt-2.5 text-sm font-medium text-white">Preço</label>
                        <input type="number" step="0.01" name="Produto_Preco" id="Produto_Preco" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>

                    <div>
                        <label for="estoque" class="block mt-2.5 text-sm font-medium text-white">Estoque</label>
                        <input type="number" name="Produto_Estoque" id="Produto_Estoque" class="bg-slate-600 border border-default-medium text-white text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>

                    <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6 mt-4">
                        <button type="submit" class="bg-[#0EB454] text-white hover:bg-[#058C42] h-10 font-bold py-2 px-6 rounded shadow uppercase text-xs tracking-widest transition ease-in-out duration-150">
                            Confirmar Alterações
                        </button>
                        <button data-modal-hide="criar-modal" type="button" class="text-white bg-slate-800 box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>  







<!-- GRAFICO DE PRODUTOS CADASTRADOS -->

   @if(Auth::user()->adm == 1)
    <button id="btnMostrarGrafico" class="mb-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition-colors">
        Histórico de Cadastros
    </button>

    <div id="containerGrafico" class="hidden bg-slate-800 p-6 rounded-xl shadow-lg mb-8 border border-slate-700">
        
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-white border-l-4 border-blue-500 pl-3">
                Histórico de Cadastros
            </h3>
            <button id="btnFecharGrafico" class="text-slate-400 hover:text-red-400 font-semibold text-sm transition-colors">
                ✕ Fechar
            </button>
        </div>
        
        <div class="relative w-full h-64 md:h-80">
            <canvas id="graficoProdutos"></canvas>
        </div>
        
    </div>


    <!-- js do gráfico  (Se der tempo, tirar daqui) -->
    <script>
        let chart = null;
        const container = document.getElementById('containerGrafico');

        document.getElementById('btnMostrarGrafico').onclick = () => {
            container.classList.remove('hidden');
            
            if (!chart) setTimeout(() => {
                chart = new Chart(document.getElementById('graficoProdutos'), {
                    type: 'bar',
                    data: {
                        labels: @json($labelsMeses),
                        datasets: [{ label: 'Cadastros', data: @json($dadosProdutos), backgroundColor: '#3b82f6' }]
                    },
                    options: { maintainAspectRatio: false } 
                });
            }, 50);
        };

        document.getElementById('btnFecharGrafico').onclick = () => container.classList.add('hidden');
    </script>

@endif

<!-- ============================ -->



















    <script>  // JS pras previews das fotos, não está na pasta js pra eu poder usar o foreach, depois eu otimizo isso
        // Preview para criar produtos
        const inputCreate = document.getElementById('foto-create');
        if(inputCreate) {
            inputCreate.addEventListener('change', function(e) {
                const [file] = e.target.files;
                if(file) {
                    document.getElementById('preview-create').src = URL.createObjectURL(file);
                }
            });
        }

        // Preview para editar produtos
        @foreach ($products as $produto)
        const inputEdit{{$produto->product_id}} = document.getElementById('foto-edit-{{$produto->product_id}}');
        if(inputEdit{{$produto->product_id}}) {
            inputEdit{{$produto->product_id}}.addEventListener('change', function(e) {
                const [file] = e.target.files;
                if(file) {
                    document.getElementById('preview-edit-{{$produto->product_id}}').src = URL.createObjectURL(file);
                }
            });
        }
        @endforeach
    </script>

    <script src="https://unpkg.com/flowbite@2.3.0/dist/flowbite.min.js"></script>




    <script src="../../../public/js/sidebar.js"></script>

</body>
</html>