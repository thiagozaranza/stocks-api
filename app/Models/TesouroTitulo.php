<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TesouroTitulo extends Model
{
    protected $table = 'tesourodireto_titulos';

    public $fillable = ['nome', 'tipo_id', 'data_inicio', 'data_vencimento'];
    public $hidden = ['created_at', 'updated_at'];
    
    public function tipo()
    {
        return $this->belongsTo('App\Models\TesouroTipo');
    }
}
