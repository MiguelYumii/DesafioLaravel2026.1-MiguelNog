<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Endereco extends Authenticatable
{
    use Notifiable;

    //conecta na tabela do endrereço
    protected $table = 'endress';

    protected $primaryKey = 'endress_id'; //chave primaira

    //tira o timestamps, já que não tem a coluna create e uptade, colocar isso no breaking change dps
    public $timestamps = false;

    //colunas pro laravel preencher
    protected $fillable = [
        'endress_photo',
        'endress_StreetNumber',
        'endress_street',
        'endress_StreetExtra',
        'endress_Bairro',
        'endress_City',
        'endress_Estado',
        'endress_cep',
        'usuarios_user_id'

    ];
}
