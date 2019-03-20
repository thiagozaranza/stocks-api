<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TesouroCategoria extends Model
{
    protected $table = 'tesourodireto_categorias';

    public $fillable = ['nome'];
    public $hidden = ['created_at', 'updated_at'];

    public function tipo()
    {
        return $this->hasMany('App\Models\TesoutoTipo');
    }
}
