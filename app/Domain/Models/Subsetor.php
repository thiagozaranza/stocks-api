<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Subsetor extends Model
{
    protected $table = 'subsetores';
    
    public function setor()
    {
        return $this->belongsTo('App\Domain\Setor');
    }

    public function segmentos()
    {
        return $this->hasMany('App\Domain\Segmento');
    }
}
