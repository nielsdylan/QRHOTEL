<?php

namespace Database\Seeders\Job;

use App\Models\Propietario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropietarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = new Propietario();
        $data->ruc = '123456789';
        $data->usuario_id = 1;
        $data->save();
    }
}
