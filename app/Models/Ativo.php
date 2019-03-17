<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ativo extends Model
{
    protected $table = 'ativos';

    public $fillable = ['tipo_id', 'empresa_id', 'codigo'];
    public $hidden = ['created_at', 'updated_at'];

    public function tipo()
    {
        return $this->belongsTo('App\Models\TipoAtivo');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    public function indices()
    {
        return $this->belongsToMany('App\Models\Indice', 'ativos_indices', 'ativo_id', 'indice_id');
    }
}
