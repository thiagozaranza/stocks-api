<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Empresa;
use App\Models\Indice;

class ImportIndicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:indices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import indices das empresas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->alert($this->signature);
        
        $lines = file('/var/www/files/Indices20190314.csv');

        $content = '';

        foreach ($lines as $line) {

            $line = trim($line);
            $line_parts = explode(';', $line);

            if (sizeof($line_parts) != 3) {
                $this->warn(implode(';', $line_parts));
                continue;
            }
            
            $codigo   = str_replace('"', '', trim($line_parts[0]));
            $nome     = str_replace('"', '', trim($line_parts[1]));
            $titulo   = str_replace('"', '', trim($line_parts[2]));

            $_indice = Indice::where('nome', $nome)->first();

            if (!$_indice) {
                $_indice = new Indice();
                $_indice->codigo = $codigo;
                $_indice->nome = $nome;
                $_indice->titulo =$titulo;
                $_indice->save();

                //$this->info($nome . " - " . $titulo);
            }
        }
    }
}