<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\Empresa;

class EmpresaRepository extends BaseRepository
{
    protected $modelClass = Empresa::class;    
}