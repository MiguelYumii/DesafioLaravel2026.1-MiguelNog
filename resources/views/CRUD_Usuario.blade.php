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
                <table class="w-full text-sm text-left rtl:text-right text-body">

                    <thead class="bg-neutral-secondary-soft border-b border-default">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium"> ID</th>
                            <th scope="col" class="px-6 py-3 font-medium"> Foto </th>
                            <th scope="col" class="px-6 py-3 font-medium"> Nome </th>
                            <th scope="col" class="px-6 py-3 font-medium"> Email </th>
                            <th scope="col" class="px-6 py-3 font-medium"> Cargo </th>
                            <th scope="col" class="px-6 py-3 font-medium flex items-center justify-center"> Ação 
                                 <button  data-modal-target="criar-modal" data-modal-toggle="criar-modal" class="px-6 py-3 font-medium flex items-center justify-center "> Criar Usuário </button>
                                
                            </th>
                           
                        </tr>
                    </thead>

                    <tbody>
                      
                        
                        @foreach ($users as $Usuario)
                        <tr class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default  ">
                            <th class="px-6 py-4" > {{$Usuario->user_id}} </th>
                            <td class="px-6 py-4">
                                @if($Usuario->user_pf && !empty($Usuario->user_pf))
                                    <img src="{{$Usuario->user_pf}}" class="w-14 h-14 rounded-full border-2 border-[#4a7bb7] object-cover">
                                @else
                                    <div class="w-14 h-14 rounded-full border-2 border-[#4a7bb7] bg-blue-700 flex items-center justify-center text-white text-xl font-bold">
                                        {{ strtoupper(substr($Usuario->user_name,0,2)) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4"> {{$Usuario->user_name}} </td>
                            <td class="px-6 py-4"> {{$Usuario->user_email}} </td>

                            <td class="px-6 py-4">
                                @if($Usuario->user_adm == 1)
                                    Administrador
                                @else
                                    Usuário
                                @endif
                            </td>
                      
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-7">
                                    <button data-modal-target="ver-modal-{{$Usuario->user_id}}" data-modal-toggle="ver-modal-{{$Usuario->user_id}}" class="font-medium text-fg-brand hover:underline">Ver</button>
                                    <button data-modal-target="editar-modal-{{$Usuario->user_id}}" data-modal-toggle="editar-modal-{{$Usuario->user_id}}" class="font-medium text-fg-brand hover:underline">Editar</button>
                                    <button data-modal-target="popup-modal-{{$Usuario->user_id}}" data-modal-toggle="popup-modal-{{$Usuario->user_id}}" class="font-medium text-fg-brand hover:underline">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default">
                          @endforeach
                        

                    </tbody>
                    
                </table>
            </div>
        </div>











  @foreach ($users as $Usuario)       
<!-- MODAL VER USUÁRIO -->
<div id="ver-modal-{{$Usuario->user_id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                    Informações do Usuário
                </h3>
            </div>
            
            <img src="{{$Usuario->user_pf}}" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7] object-cover">

            <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Nome</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$Usuario->user_name}}
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$Usuario->user_email}}
                    </div>
                </div>

                

                
                @php
                    $enderecoUsuario = $enderecos->first(function($e) use ($Usuario) {
                        return $e->usuarios_user_id == $Usuario->user_id;
                    });
                @endphp
                @if($enderecoUsuario)
                <div class="col-span-2 sm:col-span-1">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Número da Residência</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$enderecoUsuario->endress_StreetNumber}}
                    </div>
                </div>


                <div class="col-span-2 sm:col-span-1">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Cep</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$enderecoUsuario->endress_cep}}
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Logradouro</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$enderecoUsuario->endress_street}}
                    </div>
                </div>
                
                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Cidade</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$enderecoUsuario->endress_City}}
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Bairro</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$enderecoUsuario->endress_Bairro}}
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Estado</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$enderecoUsuario->endress_Estado}}
                    </div>
                </div>


                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Complemento</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$enderecoUsuario->endress_StreetExtra}}
                    </div>
                </div>
                @endif
                


                <div class="col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading">CPF</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$Usuario->user_cpf}}
                    </div>
                </div>


                <div class="col-span-2 sm:col-span-1">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Número de Telefone</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{$Usuario->user_phone}}
                    </div>
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label class="block mb-2.5 text-sm font-medium text-heading">Data de Nascimento</label>
                    <div class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full px-3 py-2.5 shadow-xs">
                        {{ \Carbon\Carbon::parse($Usuario->user_birthday)->format('d/m/Y') }}
                    </div>
                </div>  
            </div>

     
            <div class="flex items-center justify-end space-x-4 border-t border-default pt-4 md:pt-6">
                <button data-modal-hide="ver-modal-{{$Usuario->user_id}}" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-6 py-2.5 focus:outline-none transition-all">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>















<!-- MODAL DE EXCLUIR USUÁRIO -->

    <form action="{{route('destroy',$Usuario->user_id)}}" method="POST" style="display:inline;">
    @csrf
    @method('delete')

        <div id="popup-modal-{{$Usuario->user_id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                        
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-fg-disabled w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <h3 class="mb-6 text-body">Tem certeza que deseja excluir este usuário da sua conta? Está ação é irreversível</h3>
                            <div class="flex items-center space-x-4 justify-center">
                                    <button type="submit" class="text-white bg-danger box-border border border-transparent hover:bg-danger-strong focus:ring-4 focus:ring-danger-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                        Tenho certeza
                                    </button>
                            
                                <button data-modal-hide="popup-modal-{{$Usuario->user_id}}" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                    Não
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- ========================== -->









<!-- MODAL DE EDITAR USUÁRIO -->
<div id="editar-modal-{{$Usuario->user_id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
     
        
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
           
            
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                    Editar Usuário
                </h3>
            </div>
            
            <form action="{{route('update', $Usuario->user_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <img id="preview-edit-{{$Usuario->user_id}}" src="{{$Usuario->user_pf ?: '/assets/UsuarioPF/UPF.png'}}" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7] object-cover">
                <div class="col-span-2 flex flex-col items-center mb-2">
                    <label for="foto-edit-{{$Usuario->user_id}}" class="cursor-pointer text-blue-400 hover:underline">Selecionar foto de perfil</label>
                    <input type="file" name="foto" id="foto-edit-{{$Usuario->user_id}}" accept="image/*" class="hidden">
                </div>
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                        
                    <div class="col-span-2">
                        <label for="user_name" class="block mb-2.5 text-sm font-medium text-heading">Nome</label>
                        <input type="text" name="user_name" id="user_name" value="{{$Usuario->user_name}}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" required>
                    </div>

                    <div class="col-span-2">
                        <label for="user_email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                        <input type="email" name="user_email" id="user_email" value="{{$Usuario->user_email}}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>
                
                    <div class="col-span-2">
                        <label for="user_password" class="block mb-2.5 text-sm font-medium text-heading">Senha</label>
                        <input type="password" name="user_password" id="user_password" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>


                    <div class="col-span-2 sm:col-span-1">
                        <label for="endress_cep" class="block mb-2.5 text-sm font-medium text-heading">Cep</label>
                        <input type="number" name="endress_cep" id="endress_cep" value="{{$Usuario->endress_cep}}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="endress_StreetNumber" class="block mb-2.5 text-sm font-medium text-heading">Número da Residência</label>
                        <input type="number" name="endress_StreetNumber" id="endress_StreetNumber" value="{{$Usuario->endress_numerocasa}}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    </div>



                    <div class="col-span-2">
                        <label for="endress_StreetExtra" class="block mb-2.5 text-sm font-medium text-heading">Complemento</label>
                        <input type="text" name="endress_StreetExtra" id="endress_StreetExtra" value="{{$Usuario->endress_StreetExtra}}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" >
                    </div>
                
                    <div class="col-span-2">
                        <label class="block mb-2.5 text-sm font-medium text-heading">CPF</label>
                        <input type="text" name="user_cpf" id="user_cpf" value="{{$Usuario->user_cpf}}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </div>
                    </div>




                    <div class="col-span-2 sm:col-span-1">
                        <label for="user_phone" class="block mb-2.5 text-sm font-medium text-heading">Número de Telefone</label>
                        <input type="number" name="user_phone" id="user_phone" value="{{$Usuario->user_phone}}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="user_birthday" class="block mb-2.5 text-sm font-medium text-heading">Data de Nascimento</label>
                        <input type="date" name="user_birthday" id="user_birthday" value="{{$Usuario->user_birthday}}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    </div>
                   
                    
                        <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">
                            <button type="submit" class="inline-flex items-center  text-white bg-green-700 hover:bg-green-800 box-border border border-transparent focus:ring-4 focus:ring-green-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                                Confirmar alterações
                            </button>
                            <button data-modal-hide="editar-modal-{{$Usuario->user_id}}" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Cancelar</button>
                        </div>
                
                
                
                
                </div>



            </form>
        </div>
    </div>
</div> 

<!-- =============================== -->

@endforeach




dsaasdas




<!-- MODAL DE CRIAR USUÁRIO -->


<div id="criar-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
     
        
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
           
            
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                    Criar Usuário
                </h3>
            </div>
            
            <form action="/users" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')

                <img id="preview-edit-{{$Usuario->user_id}}" class="block mx-auto w-35 h-35 rounded-md mt-5 border-2 border-[#4a7bb7] object-cover"
                     src="/assets/UsuarioPF/UPF.png" alt="Foto de Perfil">       
                     <div class="col-span-2 flex flex-col items-center mb-2">
                        <label for="foto-create-{{$Usuario->user_id}}" class="cursor-pointer text-blue-400 hover:underline">Selecionar foto de perfil</label>
                        <input type="file" name="foto" id="foto-create-{{$Usuario->user_id}}" accept="image/*" class="hidden">
                     </div>
                
              
                     

                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                    <div class="col-span-2">
                        <label for="user_name" class="block mb-2.5 text-sm font-medium text-heading">Nome</label>
                        <input type="text" name="user_name" id="user_name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" required>
                    </div>

                    <div class="col-span-2">
                        <label for="user_email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                        <input type="email" name="user_email" id="user_email" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>
                
                    <div class="col-span-2">
                        <label for="user_password   " class="block mb-2.5 text-sm font-medium text-heading">Senha</label>
                        <input type="password" name="user_password" id="user_password" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>


                    <div class="col-span-2 sm:col-span-1">
                        <label for="endress_cep" class="block mb-2.5 text-sm font-medium text-heading">Cep</label>
                        <input type="number" name="endress_cep" id="endress_cep" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="endress_StreetNumber" class="block mb-2.5 text-sm font-medium text-heading">Número da Residência</label>
                        <input type="number" name="endress_StreetNumber" id="endress_StreetNumber" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>



                    <div class="col-span-2">
                        <label for="endress_StreetExtra" class="block mb-2.5 text-sm font-medium text-heading">Complemento</label>
                        <input type="text" name="endress_StreetExtra" id="endress_StreetExtra" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus-border-brand block w-full px-3 py-2.5 shadow-xs" required >
                    </div>
                
                    <div class="col-span-2">
                        <label for="user_cpf" class="block mb-2.5 text-sm font-medium text-heading">CPF</label>
                        <input type="text" name="user_cpf" id="user_cpf" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs"  required>
                        </div>
                    </div>


                    <div class="col-span-2 sm:col-span-1">
                        <label for="user_phone" class="block mb-2.5 text-sm font-medium text-heading">Número de Telefone</label>
                        <input type="number" name="user_phone" id="user_phone" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" required >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="user_birthday" class="block mb-2.5 text-sm font-medium text-heading">Data de Nascimento</label>
                        <input type="date" name="user_birthday" id="user_birthday" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs" required>
                    </div>
                   
                
                    
                                
                                    <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">
                                        <button type="submit" class="inline-flex items-center  text-white bg-green-700 hover:bg-green-800 box-border border border-transparent focus:ring-4 focus:ring-green-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                            <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                                            Confirmar alterações
                                        </button>
                                       <button data-modal-hide="criar-modal" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Cancelar</button>
                                    </div>
                
                
                
                </div>


            </form>

         
        </div>
    </div>
</div> 




<script>  // JS pras previews das fotos, não está na pasta js pra eu poder usar o foreach, depois eu otimizo isso


                // Preview para criar usuario
                const inputCreate = document.getElementById('foto-create');
                if(inputCreate) {
                    inputCreate.addEventListener('change', function(e) {
                        const [file] = e.target.files;
                        if(file) {
                            document.getElementById('preview-create').src = URL.createObjectURL(file);
                        }
                    });
                }

                // Preview para editar usuario
                @foreach ($users as $Usuario)
                const inputEdit{{$Usuario->user_id}} = document.getElementById('foto-edit-{{$Usuario->user_id}}');
                if(inputEdit{{$Usuario->user_id}}) {
                    inputEdit{{$Usuario->user_id}}.addEventListener('change', function(e) {
                        const [file] = e.target.files;
                        if(file) {
                            document.getElementById('preview-edit-{{$Usuario->user_id}}').src = URL.createObjectURL(file);
                        }
                    });
                }
                @endforeach
</script>