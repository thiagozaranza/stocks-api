<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\Ativo;

class AtivoRepository extends BaseRepository
{
    protected $modelClass = Ativo::class;    
}