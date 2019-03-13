<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

use App\Models\User;

class CacheCleanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:cc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean cache';

    public function handle()
    {
        $this->alert($this->signature);

        Cache::tags(['rest'])->flush();    
        //Cache::tags(['rpc-v1'])->flush();
        //Cache::tags(['rpc-v2'])->flush();
        //Cache::tags(['rpc-v3'])->flush();

        $this->info('Cache cleaned.');

    }
}