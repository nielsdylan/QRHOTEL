<?php

namespace Database\Seeders\Job;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = new User();
        $data->name = 'ADMIN';
        $data->email = 'admin@hotmail.com';
        $data->password = Hash::make('1234');
        $data->persona_id = 1;
        $data->save();


        $data = new User();
        $data->name = 'LUCAS ALBER';
        $data->email = 'lucas@hotmail.com';
        $data->password = Hash::make('1234');
        $data->persona_id = 5;
        $data->save();


        $data = new User();
        $data->name = 'JORGE ARMANDO';
        $data->email = 'jorge@hotmail.com';
        $data->password = Hash::make('1234');
        $data->persona_id = 6;
        $data->save();
    }
}
