<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TesouroTipo extends Model
{
    protected $table = 'tesourodireto_tipos';

    public $fillable = ['nome', 'categoria_id'];
    public $hidden = ['created_at', 'updated_at'];
    
    public function categoria()
    {
        return $this->belongsTo('App\Models\TesouroCategoria');
    }

    public function titulos()
    {
        return $this->hasMany('App\Models\TesouroTitulo');
    }
}
