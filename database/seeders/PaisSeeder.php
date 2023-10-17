<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $init = [
            0 => ['nome' => 'Brasil', 'abreviatura' => 'BR'],            
        ];
        DB::table('paises')->insert($init);
    }
}
