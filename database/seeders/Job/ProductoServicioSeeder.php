<?php

namespace Database\Seeders\Job;

use App\Models\ProductoServicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = new ProductoServicio();
        $data->codigo = '0001';
        $data->nombre = 'COCA COLA';
        $data->descripcion = 'Descripcion de la bebida';
        $data->precio = 10.00;
        $data->cantidad = 100;
        $data->producto = 1;
        $data->servicio = 0;
        $data->hotel_id = 1;
        $data->save();
        $data = new ProductoServicio();
        $data->codigo = '0002';
        $data->nombre = 'INKA COLA';
        $data->descripcion = 'Descripcion de la bebida';
        $data->precio = 15.00;
        $data->cantidad = 150;
        $data->producto = 1;
        $data->servicio = 0;
        $data->hotel_id = 1;
        $data->save();
        $data = new ProductoServicio();
        $data->codigo = '0003';
        $data->nombre = 'CHISITO';
        $data->descripcion = 'CHISITO COLOR AMARILLO';
        $data->precio = 1.50;
        $data->cantidad = 300;
        $data->producto = 1;
        $data->servicio = 0;
        $data->hotel_id = 1;
        $data->save();
        $data = new ProductoServicio();
        $data->codigo = '0004';
        $data->nombre = 'COCHERA';
        $data->descripcion = 'COCHERA PARA VEHICULOS';
        $data->precio = 20.00;
        $data->cantidad = 50;
        $data->producto = 0;
        $data->servicio = 1;
        $data->hotel_id = 1;
        $data->save();

    }
}
