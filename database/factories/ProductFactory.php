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
           
            'product_autor' => $this->faker->randomFloat(0,200),
            'product_AutorPhone' => $this->faker->phoneNumber(),
            'product_name' => $this->faker->words(3, true), 
            'product_value' => $this->faker->randomFloat(2, 10, 1000), 
            'product_stock' => $this->faker->numberBetween(0, 200), 
            'product_description' => $this->faker->sentence(10), 
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),            'product_category' => $this->faker->randomElement(['Periféricos', 'Domésticos', 'Computadores']),
            'product_image' => $this->faker->randomElement([
                                '/assets/Logos/GordoTriste.jpeg',
                                '/assets/produtos/teclado1.png',
                                '/assets/produtos/teclado2.png',
                                '/assets/produtos/Pcgamer2.png',
                                '/assets/produtos/Pcgamer.png',
                                '/assets/produtos/geladeira.jpg',
                                '/assets/produtos/Liquidificador.png',
                                '/assets/produtos/pcescritorio.jpg',
                                '/assets/produtos/MouseEscritorio.png',
                                '/assets/produtos/mouse.png',
                                
                                    
            ]),
        ];
    }
}


//   \App\Models\Product::factory()->count(10)->create();