<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleLog;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon; 

class VendasController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id; 

        if (Auth::user()->adm == 1) { 
            $vendas = SaleLog::orderBy('sale_data', 'desc')->get();
        } else {
            
            $vendas = SaleLog::where('usuarios_user_id', $userId)
                             ->orderBy('sale_data', 'desc')
                             ->get();
        }

        
        $labelsMeses = [];
        $dadosVendas = [];

        for ($i = 11; $i >= 0; $i--) {
            $data = Carbon::now()->subMonths($i);
            $mes = $data->format('m');
            $ano = $data->format('Y');

            $labelsMeses[] = $data->format('m/Y'); 

            $totalVendas = SaleLog::where('usuarios_user_id', $userId)
                ->whereYear('sale_data', $ano)
                ->whereMonth('sale_data', $mes)
                ->count();

            $dadosVendas[] = $totalVendas;
        }

        return view('vendas.index', compact('vendas', 'labelsMeses', 'dadosVendas'));
    }



    //GERADOR DO PDF
    public function gerarPDF(Request $request)
    {
        $query = \App\Models\SaleLog::query(); 

        if ($request->has('data_inicio') && $request->has('data_fim')) {
            $query->whereBetween('sale_data', [
                $request->data_inicio . ' 00:00:00',
                $request->data_fim . ' 23:59:59'
            ]);
        }

        if (Auth::user()->adm == 0) {
            $query->where('usuarios_user_id', Auth::user()->id); 
        }

        $vendas = $query->orderBy('sale_data', 'desc')->get();
        $pdf = Pdf::loadView('vendas.pdf', compact('vendas', 'request'));
        
        return $pdf->stream('relatorio_vendas.pdf');
    }





    // GERADOR DE EXCEL    
    public function exportarExcel(Request $request)
    {
        $query = \App\Models\SaleLog::query(); 

        if ($request->has('data_inicio') && $request->has('data_fim')) {
            $query->whereBetween('sale_data', [
                $request->data_inicio . ' 00:00:00',
                $request->data_fim . ' 23:59:59'
            ]);
        }
            
        $vendas = $query->orderBy('sale_data', 'desc')->get();

        $fileName = 'relatorio_vendas.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Produto', 'Data da Venda', 'Valor', 'Cliente', 'Vendedor'];
        $callback = function() use($vendas, $columns) {

            $file = fopen('php://output', 'w');
                    
            // coisa pra ler os ^´` certin
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $columns, ';');

            foreach ($vendas as $venda) {
                $row = [
                    $venda->sale_ProductName,
                    \Carbon\Carbon::parse($venda->sale_data)->format('d/m/Y H:i'),
                    'R$ ' . number_format($venda->sale_ProductValue, 2, ',', '.'),
                    $venda->sale_client,
                    $venda->sale_autor
                ];
                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}