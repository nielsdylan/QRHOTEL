<?php

namespace Database\Seeders\Job;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $data->password = '1234';
        $data->persona_id = 1;
        $data->save();
    }
}
