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

<nav class="relative bg-[#03223F] " style=" height: 140px;">

    <div class="grid grid-cols-8 gap-4">
        

        <!-- Logo do Site -->
        <a href="/" class="text-2xl font-bold text-white" style="display: flex  justify-content: center">
            <img src="/assets/Logos/Logo_MouseTech2.png" alt="Logo Mouse Tech" style="height: 130px"
                class="">
        </a>

        <!-- Barra de Pesquisa -->
        <form action="/search" method="GET" class="col-span-3 flex items-center ">
            <input type="text" name="query" placeholder="Buscar..." class="w-full  rounded-l-md px-4 py-2  focus:outline-none bg-white placeholder-gray-500">
            <button type="submit"  class="px-4 py-2 bg-blue-500 text-white  hover:bg-blue-600 " ><i class="bi bi-search"></i></button>
            <button type="button"  class="rounded-md px-4 py-2 bg-[#7e7e7e] text-white  hover:bg-[#696969]  " >Filtro</button>
        </form>


        <!-- Dashboard -->
        <a href="/" class="ml-35 flex items-center justify-center" >
             <h6 class="font-bold text-white">Dashboard</h6>
        </a>


        <!-- Carrinho -->
        <a href="/" class="ml-35 flex items-center justify-center" >
             <h6 class="font-bold text-white">Carrinho</h6>
        </a>
     

        <!-- Login -->

        <div class="self-center ml-15 ">
            <button >
                <div class=" self-center w-fit h-fit flex items-center bg-[#2b5a97] rounded-full p-1 pr-5 border border-[#3b6ba7] shadow-lg">
        
                    <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-[#4a7bb7] ">
                            <img src="/assets/Logos/UserPF.png" class="w-full h-full object-cover">
                    </div>
        
                    <div class="ml-3 flex flex-col justify-center leading-tight">
                      <span class="text-white text-xl font-bold">Yumii</span>
                       <span class="text-gray-300 text-[10px] uppercase tracking-[0.15em] font-medium"> Administrador </span>
                    </div>

                </div>
            </button>
        </div>
      
        












    </div>
</nav>




</header>
</html>