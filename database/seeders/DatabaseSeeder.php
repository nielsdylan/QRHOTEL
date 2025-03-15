<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Job\ClienteSeeder;
use Database\Seeders\Job\HotelSeeder;
use Database\Seeders\Job\PersonaSeeder;
use Database\Seeders\Job\PropietarioSeeder;
use Database\Seeders\Job\RecursosHumanosSeeder;
use Database\Seeders\Job\UsuarioSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PersonaSeeder::class,
            UsuarioSeeder::class,
            PropietarioSeeder::class,
            HotelSeeder::class,
            RecursosHumanosSeeder::class,
            ClienteSeeder::class,
        ]);
    }
}
