<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'denuncias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo',
        'vitima',
        'user_id',
        'agressor',
        'agressor_id',
        'cep',
        'rua',
        'numero',
        'bairro_id',
        'narrativa'
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
    protected $with = ['user', 'agressor', 'bairro'];

    
     public function user()
     {
         return $this->belongsTo(User::class);
     }

      public function agressor()
     {
         return $this->belongsTo(Agressor::class);
     }

     public function bairro()
     {
         return $this->belongsTo(Bairro::class);
     }
}
