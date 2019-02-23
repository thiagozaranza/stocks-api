<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\Subsetor;

class SubsetorRepository extends BaseRepository
{
    protected $modelClass = Subsetor::class;    
}