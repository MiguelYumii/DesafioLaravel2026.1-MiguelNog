<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Essa linha é o que conecta o Model à Factory!

    /**
     * Os atributos que podem ser preenchidos em massa.
     * Baseado no seu ProductController.
     *
     * @var array<int, string>
     */

    protected $table = 'product';
    
    public $timestamps = false;


    protected $fillable = [
        'product_image',
        'product_autor',
        'product_AutorPhone',
        'product_name',
        'product_value',
        'product_stock',
        'product_description',
        'product_category',
        
    ];
}