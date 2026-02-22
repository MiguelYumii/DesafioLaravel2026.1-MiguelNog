<x-app-layout>

<div class="container mx-auto p-6 bg-slate-900 min-h-screen text-white">
    
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold border-l-4 border-green-500 pl-4">Meu Histórico de Compras</h1>
        
        <!-- Fomrs de DATA INICIO e DATA FIM -->
        <form action="{{ route('historico.pdf') }}" method="POST" target="_blank" class="flex items-end gap-4 bg-slate-800 p-4 rounded-lg shadow-lg">
            @csrf
            <div>
                <label class="block text-xs uppercase font-bold text-gray-400 mb-1">Data Início</label>
                <input type="date" name="data_inicio" required class="bg-slate-700 border-none rounded text-sm text-white focus:ring-green-500">
            </div>
            <div>
                <label class="block text-xs uppercase font-bold text-gray-400 mb-1">Data Fim</label>
                <input type="date" name="data_fim" required class="bg-slate-700 border-none rounded text-sm text-white focus:ring-green-500">
            </div>
            
            <!-- pdfs -->
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-bold transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                PDF
            </button>
        </form>
    </div>

    <!-- Tabela de Compras -->
    <div class="bg-slate-800 rounded-xl overflow-hidden shadow-2xl border border-slate-700">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-700 text-gray-300 uppercase text-xs">
                    <th class="px-6 py-4">Foto</th>
                    <th class="px-6 py-4">Produto</th>
                    <th class="px-6 py-4">Data</th>
                    <th class="px-6 py-4">Valor</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-700">

                @forelse($compras as $compra)
                <tr class="hover:bg-slate-750 transition">

                    <td class="px-6 py-4">
                        @if(isset($compra->buy_ProductPhoto) && $compra->buy_ProductPhoto)
                            <img src="{{ asset($compra->buy_ProductPhoto) }}" class="w-12 h-12 object-cover rounded-lg shadow-md border border-slate-600">
                        @else
                            <div class="w-12 h-12 bg-slate-600 rounded-lg shadow-md border border-slate-500 flex items-center justify-center text-[10px] text-gray-400 text-center leading-tight">Sem<br>Foto</div>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-semibold text-green-400">{{ $compra->buy_ProductName }}</td>
                    <td class="px-6 py-4 text-gray-400">{{ \Carbon\Carbon::parse($compra->buy_data)->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 font-bold text-white">R$ {{ number_format($compra->buy_ProductValue, 2, ',', '.') }}</td>
                </tr>

                @empty
                
                <tr> 
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                        Nenhuma compra registrada até o momento.
                    </td>
                </tr>

                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-app-layout>