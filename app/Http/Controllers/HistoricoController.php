<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuyLog;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoricoController extends Controller
{
    public function index()
    {
        $compras = BuyLog::where('usuarios_user_id', Auth::id())
                         ->orderBy('buy_data', 'desc')
                         ->get();

        return view('historico.index', compact('compras'));
    }

    // fazedouros de PêDêÉfi
    public function gerarPDF(Request $request)
    {
        

        $compras = BuyLog::with('produto') 
                         ->where('usuarios_user_id', Auth::id())
                         ->whereBetween('buy_data', [
                             $request->data_inicio . ' 00:00:00',
                             $request->data_fim . ' 23:59:59'
                         ])
                         ->orderBy('buy_data', 'desc')
                         ->get();



        $pdf = Pdf::loadView('historico.pdf', compact('compras', 'request'));
        
        return $pdf->stream('historico_compras.pdf'); 
    }
}