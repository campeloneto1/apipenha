<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => [ 'nome' => 'Acre', 'abreviatura' => 'AC', 'pais_id' => 1 ],
            1 => [ 'nome' => 'Alagoas', 'abreviatura' => 'AL', 'pais_id' => 1 ],
            2 => [ 'nome' => 'Amapá', 'abreviatura' => 'AP', 'pais_id' => 1 ],
            3 => [ 'nome' => 'Amazonas', 'abreviatura' => 'AM', 'pais_id' => 1 ],
            4 => [ 'nome' => 'Bahia', 'abreviatura' => 'BA', 'pais_id' => 1 ],
            5 => [ 'nome' => 'Ceará', 'abreviatura' => 'CE', 'pais_id' => 1 ],
            6 => [ 'nome' => 'Distrito Federal', 'abreviatura' => 'DF', 'pais_id' => 1 ],
            7 => [ 'nome' => 'Espírito Santo', 'abreviatura' => 'ES', 'pais_id' => 1 ],
            8 => [ 'nome' => 'Goiás', 'abreviatura' => 'GO', 'pais_id' => 1 ],
            9 => [ 'nome' => 'Maranhão', 'abreviatura' => 'MA', 'pais_id' => 1 ],
            10 => [ 'nome' => 'Mato Grosso', 'abreviatura' => 'MT', 'pais_id' => 1 ],
            11 => [ 'nome' => 'Mato Grosso do Sul', 'abreviatura' => 'MS', 'pais_id' => 1 ],
            12 => [ 'nome' => 'Minas Gerais', 'abreviatura' => 'MG', 'pais_id' => 1 ],
            13 => [ 'nome' => 'Pará', 'abreviatura' => 'PA', 'pais_id' => 1 ],
            14 => [ 'nome' => 'Paraíba', 'abreviatura' => 'PB', 'pais_id' => 1 ],
            15 => [ 'nome' => 'Paraná', 'abreviatura' => 'PR', 'pais_id' => 1 ],
            16 => [ 'nome' => 'Pernambuco', 'abreviatura' => 'PE', 'pais_id' => 1 ],
            17 => [ 'nome' => 'Piauí', 'abreviatura' => 'PI', 'pais_id' => 1 ],
            18 => [ 'nome' => 'Rio de Janeiro', 'abreviatura' => 'RJ', 'pais_id' => 1 ],
            19 => [ 'nome' => 'Rio Grande do Norte', 'abreviatura' => 'RN', 'pais_id' => 1 ],
            20 => [ 'nome' => 'Rio Grande do Sul', 'abreviatura' => 'RS', 'pais_id' => 1 ],
            21 => [ 'nome' => 'Rondônia', 'abreviatura' => 'RO', 'pais_id' => 1 ],
            22 => [ 'nome' => 'Roraima', 'abreviatura' => 'RR', 'pais_id' => 1 ],
            23 => [ 'nome' => 'Santa Catarina', 'abreviatura' => 'SC', 'pais_id' => 1 ],
            24 => [ 'nome' => 'São Paulo', 'abreviatura' => 'SP', 'pais_id' => 1 ], 
            25 => [ 'nome' => 'Sergipe', 'abreviatura' => 'SE', 'pais_id' => 1 ],          
            26 => [ 'nome' => 'Tocantins', 'abreviatura' => 'TO', 'pais_id' => 1 ], 
        ];
        DB::table('estados')->insert($init);
    }
}
