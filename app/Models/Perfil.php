<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perfis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'administrador',
        'gestor',
        'relatorios',

        'agressores',
        'agressores_cad',
        'agressores_edt',
        'agressores_del',

        'denuncias',
        'denuncias_cad',
        'denuncias_edt',
        'denuncias_del',

        'emergencias',
        'emergencias_cad',
        'emergencias_edt',
        'emergencias_del',

        'usuarios',
        'usuarios_cad',
        'usuarios_edt',
        'usuarios_del'
        
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [];

    
    // public function estado()
    // {
    //     return $this->belongsTo(Estado::class);
    // }
}
