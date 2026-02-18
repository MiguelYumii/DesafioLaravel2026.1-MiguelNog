<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;   //deixar model pq só assim funcionou
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Endereco extends Model 
{
    use HasFactory;

   
    protected $table = 'endress';

    
    protected $primaryKey = 'endress_id';

    
    public $timestamps = false;

   
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


    public function user()
    {
        return $this->belongsTo(User::class, 'usuarios_user_id', 'id');
    }
}