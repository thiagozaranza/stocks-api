<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\TesouroTitulo;

class TesouroTituloRepository extends BaseRepository
{
    protected $modelClass = TesouroTitulo::class;    
}