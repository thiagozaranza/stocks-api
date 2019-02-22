<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    public function segmento()
    {
        return $this->belongsTo('App\Models\Segmento');
    }
}
