<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    

    protected $table = 'product';
    protected $primaryKey = 'id';
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

    public function author()
    {
        return $this->belongsTo(User::class, 'product_autor');
    }

    


}