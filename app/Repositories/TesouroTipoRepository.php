<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\TesouroTipo;

class TesouroTipoRepository extends BaseRepository
{
    protected $modelClass = TesouroTipo::class;    
}