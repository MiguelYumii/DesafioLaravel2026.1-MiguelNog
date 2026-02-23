<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'createdBy' => 1,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'birthday' => fake()->date(),
            'balance' => fake()->randomFloat(2, 0, 10000),
            'cpf' => fake()->numerify('###########'),
            'phone' => fake()->phoneNumber(),
            'userpf' => '/assets/UsuarioPF/UPF.png',
            'adm' => 0,
        ];
    }






    public function adm(): static
    {
        return $this->state(fn (array $attributes) => [
            'adm' => 1,
        ]);
    }
}

// Para criar usuários COMUNS:
// \App\Models\User::factory(50)->create();

// Para criar os Ademiros
// \App\Models\User::factory(5)->adm()->create();