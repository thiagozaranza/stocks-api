<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    protected $table = 'segmentos';

    public $fillable = ['nome', 'subsetor_id'];
    public $hidden = ['created_at', 'created_by', 'updated_at', 'updated_by'];

    public function subsetor()
    {
        return $this->belongsTo('App\Models\Subsetor');
    }

    public function empresas()
    {
        return $this->hasMany('App\Models\Empresa');
    }
}
