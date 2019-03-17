<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\Indice;

class IndiceRepository extends BaseRepository
{
    protected $modelClass = Indice::class;    
}