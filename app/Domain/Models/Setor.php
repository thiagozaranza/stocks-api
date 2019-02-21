<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setores';

    public function subsetores()
    {
        return $this->hasMany('App\Domain\Subsetor');
    }
}
