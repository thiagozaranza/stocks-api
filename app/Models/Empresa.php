<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    public $fillable = [
        'segmento_id',	
        'nome',
        'codigo',
        'subsegmento',	
        'razao_social',	
        'cnpj',	
        'nire',	
        'isin',	
        'cvm',
        'site',	
        'pais',	
        'atividade',	
        'data_constituicao',	
        'data_registro_cvm'];

    public function segmento()
    {
        return $this->belongsTo('App\Models\Segmento');
    }
}
