<?php

namespace Database\Seeders\Job;

use App\Models\MedioPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedioPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = new MedioPago();
        $data->nombre = 'Efectivo';
        $data->descripcion = 'Pago en Efectivo';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new MedioPago();
        $data->nombre = 'Tarjeta de Credito';
        $data->descripcion = 'Pago con Tarjeta de Credito';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new MedioPago();
        $data->nombre = 'Tarjeta de Debito';
        $data->descripcion = 'Pago con Tarjeta de Debito';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
    }
}
