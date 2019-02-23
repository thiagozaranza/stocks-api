<?php

namespace App\Commands;

use Illuminate\Console\Command;

class CreateCommand extends Command
{
    protected $signature = 'entity:create';

    protected $description = 'Create a standard entity classes';

    public function __construct()
    {
        parent::__construct();
    } 

    public function handle()
    {
        $this->alert($this->signature);
    }
}
