<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    protected $table = 'segmentos';

    public function subsetor()
    {
        return $this->belongsTo('App\Subsetor');
    }
}