<?php
namespace App\Repositories;

use Funceme\RestfullApi\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{
    protected $modelClass = User::class;    
}