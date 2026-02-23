<x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-bold transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                PDF
            </button>

            @if(Auth::user()->adm == 1) 
            <button formaction="{{ route('vendas.excel') }}" type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-bold transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg> 
                XLSX
            </button>
            @endif
        </form>
    </div>

    {{-- SECÇÃO DO GRÁFICO (REQUISITO 14) --}}
    @auth
        <button id="btnMostrarGrafico" class="mb-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition-colors flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
            </svg>
            Gráfico de Desempenho
        </button>

        <div id="containerGrafico" class="hidden bg-slate-800 p-6 rounded-xl shadow-lg mb-8 border border-slate-700">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-white border-l-4 border-blue-500 pl-3">
                    Vendas Realizadas (Últimos 12 Meses)
                </h3>
                <button id="btnFecharGrafico" class="text-slate-400 hover:text-red-400 font-semibold text-sm transition-colors">
                    ✕ Fechar
                </button>
            </div>
            
            <div class="relative w-full h-64 md:h-80">
                <canvas id="graficoVendas"></canvas>
            </div>
        </div>
    @endauth

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
                    @if(Auth::user()->adm == 1)
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
                <tr> 
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                        Nenhuma venda registrada até o momento.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    let chart = null;
    const container = document.getElementById('containerGrafico');

    document.getElementById('btnMostrarGrafico').onclick = () => {
        container.classList.remove('hidden');
        
        if (!chart) setTimeout(() => {
            chart = new Chart(document.getElementById('graficoVendas'), {
                type: 'line', 
                data: {
                    labels: @json($labelsMeses),
                    datasets: [{ 
                        label: 'Vendas Realizadas', 
                        data: @json($dadosVendas), 
                        borderColor: '#10b981', // Mudei para verde (combina mais com Vendas no seu layout)
                        backgroundColor: 'rgba(16, 185, 129, 0.2)', 
                        borderWidth: 3,
                        tension: 0.4, // Linha mais curvada/dinâmica
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointRadius: 4
                    }]
                },
                options: { 
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, color: '#94a3b8' },
                            grid: { color: '#334155' }
                        },
                        x: {
                            ticks: { color: '#94a3b8' },
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { labels: { color: '#fff' } }
                    }
                } 
            });
        }, 50); // Delay suave pra dar tempo do display:block renderizar a div
    };

    document.getElementById('btnFecharGrafico').onclick = () => container.classList.add('hidden');
</script>

</x-app-layout>