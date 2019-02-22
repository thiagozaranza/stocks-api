<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsetor extends Model
{
    protected $table = 'subsetores';
    
    public function setor()
    {
        return $this->belongsTo('App\Setor');
    }

    public function segmentos()
    {
        return $this->hasMany('App\Segmento');
    }
}
