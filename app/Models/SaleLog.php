<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleLog extends Model
{
    use HasFactory;

    protected $table = 'sale_log';
    protected $primaryKey = 'sale_id';
    public $timestamps = false;

    protected $fillable = [
        'sale_ProductPhoto', 
        'sale_ProductName', 
        'sale_ProductValue', 
        'sale_data', 
        'sale_client', 
        'sale_autor', 
        'usuarios_user_id', 
        'product_product_id'
    ];

    // Relacionamento para pegar a categoria do produto no PDF
    public function produto()
    {
        return $this->belongsTo(Product::class, 'product_product_id', 'product_id');
    }
}