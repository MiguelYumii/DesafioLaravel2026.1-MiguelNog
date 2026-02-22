<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * O nome da model correspondente a esta factory.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           
            'product_image' => $this->faker->imageUrl(640, 480, 'products', true), 
            'product_autor' => $this->faker->randomFloat(0,200),
            'product_AutorPhone' => $this->faker->phoneNumber(),
            'product_name' => $this->faker->words(3, true), 
            'product_value' => $this->faker->randomFloat(2, 10, 1000), 
            'product_stock' => $this->faker->numberBetween(0, 200), 
            'product_description' => $this->faker->sentence(10), 
            'product_category' => $this->faker->randomElement(['Eletrônicos', 'Periféricos', 'Domésticos', 'Computadores']),
        ];
    }
}


//   \App\Models\Product::factory()->count(10)->create();