<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    
    public function run(): void
    {
        
        Product::factory()->create([
            'product_name'        => 'PC Gamer',
            'product_value'       => 5500.00,
            'product_stock'       => 15,
            'product_category'    => 'Computadores',
            'product_description' => 'Computador gamer.',
            'product_image'       => '/assets/produtos/Pcgamer.png',
        ]);

        

        Product::factory(36)->create();
    }
}