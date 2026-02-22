<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyLog extends Model
{
    use HasFactory;

    protected $table = 'buy_log';
    protected $primaryKey = 'buy_id';
    public $timestamps = false;

    
    protected $fillable = [
        'buy_ProductPhoto', 
        'buy_ProductName', 
        'buy_ProductValue', 
        'buy_data', 
        'buy_autor', 
        'buy_client', 
        'usuarios_user_id',    //se der tempo, trocar esses nomes de "usuarios_user", não sei oq tava 
        'product_product_id'   //na cabeça que fiz a modelagem
    ];

     protected $casts = [
        'buy_data' => 'datetime'
    ];

    public function produto()
    {

        return $this->belongsTo(Product::class, 'product_product_id', 'product_id');    
        
    }
}