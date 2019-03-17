<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAtivo extends Model
{
    protected $table = 'tipos_ativos';

    public $fillable = ['nome', 'codigo'];
    public $hidden = ['created_at', 'updated_at'];
}
