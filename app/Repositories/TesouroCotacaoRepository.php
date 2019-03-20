<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\TesouroCotacao;

class TesouroCotacaoRepository extends BaseRepository
{
    protected $modelClass = TesouroCotacao::class;    
}