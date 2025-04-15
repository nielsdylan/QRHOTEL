<?php

namespace Database\Seeders\Job;

use App\Models\EstadoHabitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoHabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = new EstadoHabitacion();
        $data->nombre = 'Disponible';
        $data->descripcion = 'Habitacion Disponible';
        $data->icon = 'fa fa-bed';
        $data->color = 'text-success';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new EstadoHabitacion();
        $data->nombre = 'Limpia D';
        $data->descripcion = 'Habitacion Limpia Disponible';
        $data->icon = 'fa fa-bed';
        $data->color = 'text-primary';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new EstadoHabitacion();
        $data->nombre = 'Limpia O';
        $data->descripcion = 'Habitacion Limpia Ocupada';
        $data->icon = 'fa fa-bed';
        $data->color = 'text-primary';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new EstadoHabitacion();
        $data->nombre = 'Sucio D';
        $data->descripcion = 'Habitacion Sucia Disponible';
        $data->icon = 'fa fa-bed';
        $data->color = 'text-warning';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new EstadoHabitacion();
        $data->nombre = 'Sucio O';
        $data->descripcion = 'Habitacion Sucia Ocupada';
        $data->icon = 'fa fa-bed';
        $data->color = 'text-warning';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new EstadoHabitacion();
        $data->nombre = 'En Mantenimiento';
        $data->descripcion = 'Habitacion en Mantenimiento';
        $data->icon = 'fa fa-bed';
        $data->color = 'success';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new EstadoHabitacion();
        $data->nombre = 'Reservada';
        $data->descripcion = 'Habitacion Reservada';
        $data->icon = 'fa fa-bed';
        $data->color = 'text-pink';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new EstadoHabitacion();
        $data->nombre = 'Ocupada';
        $data->descripcion = 'Habitacion Ocupada';
        $data->icon = 'fa fa-bed';
        $data->color = 'text-danger';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
        $data = new EstadoHabitacion();
        $data->nombre = 'Fuera de Servicio';
        $data->descripcion = 'Habitacion Fuera de Servicio';
        $data->icon = 'fa fa-bed';
        $data->color = 'text-danger';
        $data->estado = 1;
        $data->hotel_id = 1;
        $data->save();
    }
}
