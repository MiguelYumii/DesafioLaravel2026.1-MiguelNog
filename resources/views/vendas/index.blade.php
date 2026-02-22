<x-app-layout>

<div class="container mx-auto p-6 bg-slate-900 min-h-screen text-white">
    
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold border-l-4 border-green-500 pl-4">Histórico de Vendas</h1>
        
        {{-- Formulário de Filtro e Relatório --}}
        <form action="{{ route('vendas.pdf') }}" method="POST" class="flex items-end gap-4 bg-slate-800 p-4 rounded-lg shadow-lg">
            @csrf
            <div>
                <label class="block text-xs uppercase font-bold text-gray-400 mb-1">Data Início</label>
                <input type="date" name="data_inicio" required class="bg-slate-700 border-none rounded text-sm text-white focus:ring-green-500">
            </div>
            <div>
                <label class="block text-xs uppercase font-bold text-gray-400 mb-1">Data Fim</label>
                <input type="date" name="data_fim" required class="bg-slate-700 border-none rounded text-sm text-white focus:ring-green-500">
            </div>
            
            <!-- Botão de gerar PDF -->
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-bold transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                PDF
            </button>

            <!-- Botão de  XLSX dos ademiros-->
            @if(Auth::user()->adm == 1) 
            <button formaction="{{ route('vendas.excel') }}" type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-bold transition flex items-center gap-2">
                <!-- icone da pastinha do xlsx -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg> 
                XLSX
            </button>
            @endif
        </form>
    </div>

    {{-- Tabela de Vendas --}}
    <div class="bg-slate-800 rounded-xl overflow-hidden shadow-2xl border border-slate-700">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-700 text-gray-300 uppercase text-xs">
                    <th class="px-6 py-4">Foto</th>
                    <th class="px-6 py-4">Produto</th>
                    <th class="px-6 py-4">Data</th>
                    <th class="px-6 py-4">Valor</th>
                    <th class="px-6 py-4">Cliente</th>
                    @if(Auth::user()->adm == 1)     <!-- caso seja adm, mostrar o id do autor-->
                        <th class="px-6 py-4">Vendedor (Autor)</th>
                    @endif
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-700">

                @forelse($vendas as $venda)
                <tr class="hover:bg-slate-750 transition">

                    <td class="px-6 py-4">
                        <img src="{{ asset($venda->sale_ProductPhoto) }}" class="w-12 h-12 object-cover rounded-lg shadow-md border border-slate-600">
                    </td>

                    <td class="px-6 py-4 font-semibold text-green-400">{{ $venda->sale_ProductName }}</td>
                    <td class="px-6 py-4 text-gray-400">{{ \Carbon\Carbon::parse($venda->sale_data)->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 font-bold text-white">R$ {{ number_format($venda->sale_ProductValue, 2, ',', '.') }}</td>
                    <td class="px-6 py-4 italic text-gray-300">{{ $venda->sale_client }}</td>
                    @if(Auth::user()->adm == 1)
                        <td class="px-6 py-4 text-blue-400 font-bold">{{ $venda->sale_autor }}</td>
                    @endif
                </tr>

                @empty
                
                <tr> <!-- casp n tenha V E N D A S -->
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                        Nenhuma venda registrada até o momento.
                    </td>
                </tr>


                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-app-layout>