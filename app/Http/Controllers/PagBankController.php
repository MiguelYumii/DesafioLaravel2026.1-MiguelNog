<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\BuyLog;
use App\Models\SaleLog;

class PagBankController extends Controller
{
    public function processarCompra(Request $request, $id)
{
    
    /** @var \App\Models\User $user */
    $user = Auth::user();
    
    $produto = Product::findOrFail($id);
    $quantidade = $request->input('quantidade', 1);
    
    $valorTotal = $produto->product_value * $quantidade;

    // caso o usuário tenha saldo
    if ($user->balance >= $valorTotal) {
        $user->balance -= $valorTotal;
        $user->save(); 


        $produto->product_stock -= $quantidade;
        $produto->save();

        // logzada do usuário
        BuyLog::create([
            'buy_ProductPhoto' => $produto->product_image,
            'buy_ProductName' => $produto->product_name,
            'buy_ProductValue' => $valorTotal,
            'buy_data' => now(), // código pra pegar a data e hora na hora
            'buy_autor' => $produto->product_autor, // borabill vendedor
            'buy_client' => $user->name, // calabreso comprador
            'usuarios_user_id' => $user->id,
            'product_product_id' => $produto->product_id
        ]);

        SaleLog::create([
            'sale_ProductPhoto' => $produto->product_image,
            'sale_ProductName'  => $produto->product_name,
            'sale_ProductValue' => $valorTotal,
            'sale_data'         => now(),
            'sale_client'       => Auth::user()->name, // bora bill
            'sale_autor'        => $produto->product_autor, // bora filho do bill
            'usuarios_user_id'  => $produto->product_autor, //bora filho denovo
            'product_product_id'=> $produto->product_id
        ]);


    
        return back();
    }

    // chama api do pag sucumba
    return $this->gerarCheckoutPagBank($user, $produto, $quantidade, $valorTotal);
}




    private function gerarCheckoutPagBank($user, $produto, $quantidade, $valorTotal)
    {
        $token = env('PAGBANK_TOKEN');

        $dadosPedido = [
            "reference_id" => "compra-" . time(),
            "customer" => [
                "name" => $user->name,
                "email" => $user->email,
                "tax_id" => "12345678909"
            ],
            "items" => [
                
                "reference_id" => "prod-" . $produto->product_id,
                "name" => $produto->product_name,
                "quantity" => (int)$quantidade,
                "unit_amount" => (int)($produto->product_value * 100)
                
            ],
            "redirect_url" => "https://www.google.com.br",
        ];



        /** @var \Illuminate\Http\Client\Response $response */
        $response = Http::withToken($token)
        
            ->acceptJson()
            ->post("https://sandbox.api.pagseguro.com/checkouts", $dadosPedido);

        if ($response->successful()) {
            $linkPagamento = $response->json()['links'][1]['href']; 
            return redirect()->away($linkPagamento);
        }

        return "Erro PagBank: " . $response->body();

    }
}
