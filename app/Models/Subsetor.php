<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsetor extends Model
{
    protected $table = 'subsetores';

    public $fillable = ['nome', 'setor_id'];
    public $hidden = ['created_at', 'created_by', 'updated_at', 'updated_by'];
    
    public function setor()
    {
        return $this->belongsTo('App\Models\Setor');
    }

    public function segmentos()
    {
        return $this->hasMany('App\Models\Segmento');
    }
}
