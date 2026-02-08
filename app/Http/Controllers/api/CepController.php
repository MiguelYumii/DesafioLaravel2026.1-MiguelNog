<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class CepController extends Controller
{
    public function show($cep)
    {
        if(!preg_match('/^[0-9]{8}$/', $cep)){
            return response()->json([
                'error' => 'CEP Invalido! Use 8 digitos (Ex 00001000)'
            ], 400);
        }

        $client = new Client();
        $url = "https://viacep.com.br/ws/{$cep}/json/";
 
        try{
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if(isset($data['erro'])){
                return response()->json([
                    'error' => 'CEP não encontrado!'
                ], 404);
            }

            return response()->json($data);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao consultar o CEP: ' . $e->getMessage()
            ], 500);

        }
 
 
        }
}