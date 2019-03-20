<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\TesouroCategoria;

class TesouroCategoriaRepository extends BaseRepository
{
    protected $modelClass = TesouroCategoria::class;    
}