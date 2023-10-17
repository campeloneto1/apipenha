<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => '1º Batalhão de Polícia Militar', 'abreviatura' => '1ºBPM', 'orgao_id' => 1],            
            1 => ['nome' => '2º Batalhão de Polícia Militar', 'abreviatura' => '2ºBPM', 'orgao_id' => 1],            
            2 => ['nome' => '3º Batalhão de Polícia Militar', 'abreviatura' => '3ºBPM', 'orgao_id' => 1],            
            3 => ['nome' => '4º Batalhão de Polícia Militar', 'abreviatura' => '4ºBPM', 'orgao_id' => 1],            
        ];
        DB::table('unidades')->insert($init);
    }
}
