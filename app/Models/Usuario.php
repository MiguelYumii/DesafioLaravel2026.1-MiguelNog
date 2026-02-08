<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    //conecta na tabela dos usuarios
    protected $table = 'usuarios';

    protected $primaryKey = 'user_id'; //chave primaira

    //tira o timestamps, já que não tem a coluna create e uptade, colocar isso no breaking change dps
    public $timestamps = false;


    //colunas pro laravel preencher
    protected $fillable = [

        'user_name',
        'user_email',
        'user_adm',
        'user_password',
        'user_phone',
        'user_birthday',
        'user_cpf',
        'user_balance',
        'user_pf',
        'user_createdBy'
    ];
    

    //avisando pro laravel que minha senha é diferente da tabela deles
    public function getAuthPassword()
    {
        return $this->user_password;
    }
}