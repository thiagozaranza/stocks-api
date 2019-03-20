<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TesouroTitulo extends Model
{
    protected $table = 'tesourodireto_cotacoes';

    public $fillable = ['nome', 'titulo_id', 'data', 'taxa_compra', 'taxa_venda', 'preco_compra', 'preco_venda', 'preco_base'];
    public $hidden = ['created_at', 'updated_at'];
    
    public function titulo()
    {
        return $this->belongsTo('App\Models\TesouroTitulo');
    }
}
