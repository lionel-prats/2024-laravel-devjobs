<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VacanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++){
            DB::table('vacantes')->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'titulo' => "titulo vacante " . $i+1,
                'salario_id' => 1,
                'categoria_id' => 1,
                'Empresa' => "Empresa " . $i+1,
                'ultimo_dia' => date('Y-m-d'),
                'descripcion' => "descripcion vacante " . $i+1,
                'imagen' => "OLSxFQvYvFcjHFTeX1hkh7VVlHog5rMWGfmY7iHs.jpg",
                'publicado' => 1,
                'user_id' => 4,
            ]);
        }
    }
}
