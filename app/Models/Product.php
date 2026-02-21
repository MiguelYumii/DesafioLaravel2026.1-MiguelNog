<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false; 
    protected $primaryKey = 'product_id';
    
    public function autor()
    {
        
        return $this->belongsTo(User::class, 'product_autor'); 
    }
}