<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setores';

    public $fillable = ['nome'];
    public $hidden = ['created_at', 'created_by', 'updated_at', 'updated_by'];

    public function subsetores()
    {
        return $this->hasMany('App\Models\Subsetor');
    }
}
