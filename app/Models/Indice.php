<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indice extends Model
{
    protected $table = 'indices';

    public $fillable = ['nome', 'codigo', 'descricao'];
    public $hidden = ['created_at', 'updated_at'];

    public function ativos()
    {
        return $this->belongsToMany('App\Models\Ativo', 'ativos_indices', 'indice_id', 'ativo_id');
    }
}