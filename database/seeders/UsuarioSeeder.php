<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            0 => ['nome' => 'Jose de Barros Campelo Neto', 'email' => 'pmcebarros@gmail.com', 'cpf' => '05906219471', 'telefone1' => '88999492036', 'perfil_id' => 1, 'password' => bcrypt('123456')],            
        ];
        DB::table('users')->insert($init);
    }
}
