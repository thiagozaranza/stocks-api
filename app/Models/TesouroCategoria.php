<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TesouroCategoria extends Model
{
    protected $table = 'tesourodireto_categorias';

    public $fillable = ['nome'];
    public $hidden = ['created_at', 'updated_at'];

    public function tipos()
    {
        return $this->hasMany('App\Models\TesouroTipo', 'categoria_id', 'id');
    }
}
