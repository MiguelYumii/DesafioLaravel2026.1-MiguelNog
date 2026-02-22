<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Compras</title>
    
    <link rel="stylesheet" href="\resources\css\pdf.css">
</head>
<body>

    <h2 class="titulo-relatorio">Relatório de Compras</h2>
    
    <div class="periodo-relatorio">
        Período: {{ \Carbon\Carbon::parse($request->data_inicio)->format('d/m/Y') }} 
        até {{ \Carbon\Carbon::parse($request->data_fim)->format('d/m/Y') }}
    </div>

    <table class="tabela-compras">
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th>Comprador</th>
                <th>Vendedor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
                <tr>
                    <td>{{ $compra->buy_data->format('d/m/Y') }}</td>
                    <td>R$ {{ number_format($compra->buy_ProductValue, 2, ',', '.') }}</td>
                    <td>{{ $compra->produto->product_category->name ?? 'Sem Categoria' }}</td> 
                    <td>{{ $compra->buy_client }}</td>
                    <td>{{ $compra->buy_autor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>