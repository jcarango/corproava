<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Juan Arango',
            'email' => 'jcarango98@gmail.com',
            'password' => Hash::make('Albion21')
        ]);
        DB::table('profesionales')->insert([
            'name' => 'Diego',
            'lastname' => 'Sánchez',
            'profesion' => 'Tecnólogo Forestal',
            'email' => 'elguasimo@yahoo.es',
            'phone' => '555555555'
        ]);
        DB::table('profesionales')->insert([
            'name' => 'Juan',
            'lastname' => 'Cardona',
            'profesion' => 'Tecnólogo Ambiental',
            'email' => 'fuenteviva@adamm.com.co',
            'phone' => '44444444'
        ]);
        DB::table('asociacions')->insert([
            'name' => 'Corporación Proava',
            'contactname' => 'Juan Arango',
            'email' => 'jcarango98@gmail.com',
            'phone' => '3028662461'
        ]);
        DB::table('beneficiarios')->insert([
            'name' => 'Evanys',
            'lastname' => 'Valderrama',
            'email' => '1@1l.com',
            'phone' => '2020202020'
        ]);
        DB::table('beneficiarios')->insert([
            'name' => 'Juan',
            'lastname' => 'Arango',
            'email' => 'jcarango98@gmail.com',
            'phone' => '3028662461'
        ]);
        DB::table('productos')->insert([
            'name' => 'Piscicultura Chigorodó',
            'description' => 'Proyecto Piscicultura Chigorodó',
        ]);
        $this->call(EstadosProyectosSeeder::class);
        $this->call(CountriesStatesCitiesTableSeeder::class);
    }
}
