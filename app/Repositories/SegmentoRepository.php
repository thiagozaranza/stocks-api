<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\Segmento;

class SegmentoRepository extends BaseRepository
{
    protected $modelClass = Segmento::class;    
}