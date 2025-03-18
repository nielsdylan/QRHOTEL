<?php

namespace Database\Seeders\Job;

use App\Models\Tarifa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = new Tarifa();
        $data->nombre = '24Hrs';
        $data->hotel_id = 1;
        $data->save();
        $data = new Tarifa();
        $data->nombre = '12Hrs';
        $data->hotel_id = 1;
        $data->save();
        $data = new Tarifa();
        $data->nombre = '6Hrs';
        $data->hotel_id = 1;
        $data->save();
        $data = new Tarifa();
        $data->nombre = '4Hrs';
        $data->hotel_id = 1;
        $data->save();
    }
}
