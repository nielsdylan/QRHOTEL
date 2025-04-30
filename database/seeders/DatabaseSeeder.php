<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Job\CategoriaSeeder;
use Database\Seeders\Job\ClienteSeeder;
use Database\Seeders\Job\EstadoHabitacionSeeder;
use Database\Seeders\Job\HabitacionSeeder;
use Database\Seeders\Job\HotelSeeder;
use Database\Seeders\Job\MedioPagoSeeder;
use Database\Seeders\Job\NivelSeeder;
use Database\Seeders\Job\PersonaSeeder;
use Database\Seeders\Job\ProductoServicioSeeder;
use Database\Seeders\Job\PropietarioSeeder;
use Database\Seeders\Job\RecursosHumanosSeeder;
use Database\Seeders\Job\TarifaSeeder;
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
            CategoriaSeeder::class,
            NivelSeeder::class,
            TarifaSeeder::class,
            HabitacionSeeder::class,
            EstadoHabitacionSeeder::class,
            MedioPagoSeeder::class,
            ProductoServicioSeeder::class,
        ]);
    }
}
