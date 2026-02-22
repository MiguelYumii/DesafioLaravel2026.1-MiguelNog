<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleLog;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class VendasController extends Controller
{
    public function index()
{
    
    if (Auth::user()->adm == 1)
    { 
        $vendas = SaleLog::orderBy('sale_data', 'desc')->get();
   
    } else {

        $vendas = SaleLog::where('sale_autor', Auth::user()->name)
                         ->orderBy('sale_data', 'desc')
                         ->get();

    }

    return view('vendas.index', compact('vendas'));
    
    }



   public function gerarPDF(Request $request)
    {
        $query = \App\Models\SaleLog::query(); 

        if ($request->has('data_inicio') && $request->has('data_fim')) {
            $query->whereBetween('sale_data', [
                $request->data_inicio . ' 00:00:00',
                $request->data_fim . ' 23:59:59'
            ]);
        }

        $vendas = $query->orderBy('sale_data', 'desc')->get();
        $pdf = Pdf::loadView('vendas.pdf', compact('vendas', 'request'));
        
        return $pdf->stream('relatorio_vendas.pdf');
    }



    //exportar o excéuu no xlsx
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
                

        //coisa pra ler os ^´` certin
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

