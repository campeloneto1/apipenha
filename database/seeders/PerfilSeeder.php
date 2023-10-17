<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $init = [
            0 => ['nome' => 'Administrador', 'administrador' => 1, 'gestor' => 1, 'relatorios' => 1],            
        ];
        DB::table('perfis')->insert($init);
    }
}
