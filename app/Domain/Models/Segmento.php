<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    protected $table = 'segmentos';

    public function subsetor()
    {
        return $this->belongsTo('App\Domain\Subsetor');
    }

    public function empresas()
    {
        return $this->hasMany('App\Domain\Empresa');
    }
}
