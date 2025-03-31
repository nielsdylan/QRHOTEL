<?php

namespace Database\Seeders\Job;

use App\Models\RecursoHumano;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecursosHumanosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = new RecursoHumano();
        $data->hotel_id = 1;
        $data->usuario_id = 1;
        $data->save();
        $data = new RecursoHumano();
        $data->hotel_id = 2;
        $data->usuario_id = 1;
        $data->save();


        $data = new RecursoHumano();
        $data->hotel_id = 1;
        $data->usuario_id = 2;
        $data->save();

        $data = new RecursoHumano();
        $data->hotel_id = 2;
        $data->usuario_id = 3;
        $data->save();
    }
}
