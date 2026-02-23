<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Conectando a Factory E forçando TODAS as informações do Admin
        User::factory()->create([
            'name'              => 'Administrador Mouse Tech',
            'email'             => 'admin@mousetech.com.br',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin123'),
            'remember_token'    => Str::random(10),
            'birthday'          => '1990-01-01',
            'balance'           => 9999.99,
            'cpf'               => '00000000000',
            'phone'             => '24999999999',
            'userpf'            => '/assets/UsuarioPF/UPF.png',
            'adm'               => 1,
            
        ]);

        // 2. Conectando a Factory E forçando TODAS as informações do Cliente
        User::factory()->create([
            'name'              => 'Cliente Teste',
            'email'             => 'cliente@teste.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('cliente123'),
            'remember_token'    => Str::random(10),
            'birthday'          => '2000-05-20',
            'balance'           => 150.00,
            'cpf'               => '11111111111',
            'phone'             => '24888888888',
            'userpf'            => '/assets/UsuarioPF/UPF.png',
            'adm'               => 0,
           
        ]);

        // 3. Rodando a Factory para gerar o volume de testes aleatórios
        User::factory(20)->create(); 
        User::factory(3)->adm()->create();
    }
}