<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
   
    protected $table = 'usuarios';

    // chave primaira é "user_id" 
    protected $primaryKey = 'user_id';

     
    public $timestamps = false;
}