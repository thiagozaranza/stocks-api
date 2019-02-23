<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\Setor;

class SetorRepository extends BaseRepository
{
    protected $modelClass = Setor::class;    
}