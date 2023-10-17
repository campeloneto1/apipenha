<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        $this->call([          
            OrgaoSeeder::class,
            UnidadeSeeder::class,
            SubunidadeSeeder::class,
            PaisSeeder::class,
            EstadoSeeder::class,
            PerfilSeeder::class,
            UsuarioSeeder::class,         
        ]);
        Schema::enableForeignKeyConstraints();
    }


}
