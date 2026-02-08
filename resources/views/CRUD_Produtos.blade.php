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




        <div class="bg-[#1a1a1a] min-h-screen w-full font-sans text-white p-4">
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm table-fixed text-left rtl:text-right text-body">

                    <thead class="bg-neutral-secondary-soft border-b border-default">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium"> ID</th>
                            <th scope="col" class="px-6 py-3 font-medium"> Foto </th>
                            <th scope="col" class="px-6 py-3 font-medium"> Nome </th>
                            <th scope="col" class="px-6 py-3 font-medium"> Descrição </th>
                            <th scope="col" class="px-6 py-3 font-medium"> Categoria </th>
                            <th scope="col" class="px-6 py-3 font-medium"> Autor </th>
                            <th scope="col" class="px-6 py-3 font-medium flex items-center justify-center"> Ação 
                                 <button  data-modal-target="criar-modal" data-modal-toggle="criar-modal" class="px-6 py-3 font-medium flex items-center justify-center "> Criar Usuário </button>
                                
                            </th>
                           
                        </tr>
                    </thead>

                    <tbody>
                      
                        <tr class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default  ">
                            <th class="px-6 py-4" > 1 </th>
                            <td class="px-6 py-4">  <img src="/assets/Logos/UserPF.png" class="w-30 h-30 rounded-md border-2 border-[#4a7bb7]"> </td>
                            <td class="px-6 py-4"> Mariposa Gamer </td>
                            <td class="px-6 py-4"> Fantasia Furro de Mariposa muito legal </td>
                            <td class="px-6 py-4"> Fantasia </td>
                            <td class="px-6 py-4"> Fulano da Silva </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-column items-center justify-center gap-7">
                                    <button  data-modal-target="ver-modal" data-modal-toggle="ver-modal" class="font-medium text-fg-brand hover:underline">Ver</button>
                                    <button  data-modal-target="editar-modal" data-modal-toggle="editar-modal" class="font-medium text-fg-brand hover:underline">Editar</button>
                                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"   class="font-medium text-fg-brand hover:underline">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default">
                        
                    </tbody>
                    
                </table>
            </div>
        </div>










<!-- MODAL VER ADM -->

<div id="ver-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                    Dados do Produto
                </h3>
            </div>
            
            <img src="/assets/Logos/UserPF.png" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7] object-cover">

            <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Nome</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        Mariposa Gamer
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Descrição</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        Fantasia Furro de Mariposa muito legal
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Categoria</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        Fantasia
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Autor</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        Fulano da Silva
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-end space-x-4 border-t border-default pt-4 md:pt-6">
                <button data-modal-hide="ver-modal" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-6 py-2.5 focus:outline-none transition-all">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>















<!-- MODAL DE EXCLUIR ADM -->


        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">

                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-fg-disabled w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <h3 class="mb-6 text-body">Tem certeza que deseja excluir este produto da loja?  Está ação é irreversível</h3>
                            <div class="flex items-center space-x-4 justify-center">
                                <button data-modal-hide="popup-modal" type="button" class="text-white bg-danger box-border border border-transparent hover:bg-danger-strong focus:ring-4 focus:ring-danger-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                Tenho certeza
                                </button>
                                <button data-modal-hide="popup-modal" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Não</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- ================================ -->














<!-- MODAL DE EDITAR ADM -->


<div id="editar-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
     
        
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
           
            
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                    Editar Produto
                </h3>
            </div>
            
            <form action="#">

                <img src="/assets/Logos/UserPF.png" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7]">
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Nome</label>
                        <input type="text" name="name" id="name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>

                    <div class="col-span-2">
                        <label for="descricao" class="block mb-2.5 text-sm font-medium text-heading">Descrição</label>
                        <input type="text" name="descricao" id="descricao" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>
                
                    <div class="col-span-2">
                        <label for="categoria" class="block mb-2.5 text-sm font-medium text-heading">Categoria</label>
                        <input type="text" name="categoria" id="categoria" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>

                    <div class="col-span-2">
                        <label for="autor" class="block mb-2.5 text-sm font-medium text-heading">Autor</label>
                        <input type="text" name="autor" id="autor" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>

                    <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">
                        <button type="submit" class="max-h-11 inline-flex items-center  text-white bg-green-700 hover:bg-green-800 box-border border border-transparent focus:ring-4 focus:ring-green-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                            <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                            Confirmar alterações
                        </button>
                        <button data-modal-hide="editar-modal" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Cancelar</button>
                    </div>
                
                </div>

            </form>
        </div>
    </div>
</div> 

<!-- =============================== -->












<!-- MODAL DE CRIAR ADM -->


<div id="criar-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
     
        
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
           
            
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                   Criar Produto
                </h3>
            </div>
            
            <form action="#">

                <img src="/assets/Logos/UserPF.png" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7]">
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Nome</label>
                        <input type="text" name="name" id="name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" >
                    </div>

                    <div class="col-span-2">
                        <label for="descricao" class="block mb-2.5 text-sm font-medium text-heading">Descrição</label>
                        <input type="text" name="descricao" id="descricao" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>
                
                    <div class="col-span-2">
                        <label for="categoria" class="block mb-2.5 text-sm font-medium text-heading">Categoria</label>
                        <input type="text" name="categoria" id="categoria" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>


                    <div class="col-span-2 sm:col-span-1">
                        <label for="autornumero" class="block mb-2.5 text-sm font-medium text-heading">Número do Autor</label>
                        <input type="number" name="autornumero" id="autornumero" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="quantidade" class="block mb-2.5 text-sm font-medium text-heading">Quantidade</label>
                        <input type="number" name="quantidade" id="quantidade" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="autor" class="block mb-2.5 text-sm font-medium text-heading">Autor</label>
                        <input type="text" name="autor" id="autor" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="preco" class="block mb-2.5 text-sm font-medium text-heading">Preço</label>
                        <input type="number" name="preco" id="preco" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    </div>

                    
                

                        <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">
                            <button type="submit" class="inline-flex max-h-11 items-center  text-white bg-green-700 hover:bg-green-800 box-border border border-transparent focus:ring-4 focus:ring-green-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                                Postar Produto
                            </button>
                           <button data-modal-hide="criar-modal" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Cancelar</button>
                        </div>
                
                
                
                </div>
            </form>
        </div>
    </div>
</div> 
