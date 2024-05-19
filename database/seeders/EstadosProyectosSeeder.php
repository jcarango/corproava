<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('estado_proyectos')->insert([
            ['name' => 'Proceso de Contacto'],
            ['name' => 'Creado'],
            ['name' => 'En Elaboración'],
            ['name' => 'En Oferta EPC'],
            ['name' => 'En Oferta PPA'],
            ['name' => 'Enviado'],
            ['name' => 'Aprobado'],
            ['name' => 'Ejecución'],
            ['name' => 'Entregado'],
            ['name' => 'Sin Ejecución'],
            ['name' => 'Detenido'],
            ['name' => 'No Entregado'],
            ['name' => 'Rechazado'],
        ]);
    }
}
