<?php

if(!function_exists("CheckCep")){

    function CheckCep(string $cep){

    $response =  Http::get("viacep.com.br/ws/". $cep ."/json/");
    return $response->json();
    };

}