<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <title>Relatório de Vendas</title>
        
</head>
<body>

    <h1>Relatório de Vendas</h1>
    
    <div>
        Período filtrado: 
        <strong>{{ \Carbon\Carbon::parse($request->data_inicio)->format('d/m/Y') }}</strong> 
        até 
        <strong>{{ \Carbon\Carbon::parse($request->data_fim)->format('d/m/Y') }}</strong>
    </div>


    <table>

        <thead>
            <tr>
                <th>Produto</th>
                <th>Data da Venda</th>
                <th>Valor</th>
                <th>Comprador (Cliente)</th>
                <th>Vendedor (Autor)</th>
            </tr>
        </thead>

        <tbody>
            @forelse($vendas as $venda)
                <tr>
                    <td>{{ $venda->sale_ProductName }}</td>
                    <td>{{ \Carbon\Carbon::parse($venda->sale_data)->format('d/m/Y H:i') }}</td>
                    <td class="valor">R$ {{ number_format($venda->sale_ProductValue, 2, ',', '.') }}</td>
                    <td>{{ $venda->sale_client }}</td>
                    <td>{{ $venda->sale_autor }}</td>
                </tr>
            @empty
                <tr>
                    <td>Nenhuma venda registrada nesse período.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>