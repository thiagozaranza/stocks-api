<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportDadosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:dados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import dados';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $this->call('migrate');
        $this->call('passport:install', ['--force'=>'default']);

        $this->call('db:seed');
        
        $this->call('roles:sync');

        $this->call('import:setorial');        
        $this->call('import:indices');
        $this->call('import:empresas-indices');
    }
}