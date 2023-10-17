<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubunidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => '1ª Companhia do 1º BPM', 'abreviatura' => '1ªCIA/1ºBPM', 'unidade_id' => 1],            
            1 => ['nome' => '2ª Companhia do 1º BPM', 'abreviatura' => '2ªCIA/1ºBPM', 'unidade_id' => 1],            
            2 => ['nome' => '3ª Companhia do 1º BPM', 'abreviatura' => '3ªCIA/1ºBPM', 'unidade_id' => 1],            
            3 => ['nome' => '4ª Companhia do 1º BPM', 'abreviatura' => '4ªCIA/1ºBPM', 'unidade_id' => 1],   
            4 => ['nome' => '1ª Companhia do 2º BPM', 'abreviatura' => '1ªCIA/2ºBPM', 'unidade_id' => 2],            
            5 => ['nome' => '2ª Companhia do 2º BPM', 'abreviatura' => '2ªCIA/2ºBPM', 'unidade_id' => 2],            
            6 => ['nome' => '3ª Companhia do 2º BPM', 'abreviatura' => '3ªCIA/2ºBPM', 'unidade_id' => 2],            
            7 => ['nome' => '4ª Companhia do 2º BPM', 'abreviatura' => '4ªCIA/2ºBPM', 'unidade_id' => 2],           
        ];
        DB::table('subunidades')->insert($init);
    }
}
