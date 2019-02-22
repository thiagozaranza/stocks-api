<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Empresa;
use App\Models\Setor;
use App\Models\Subsetor;
use App\Models\Segmento;

class ImportSetorialCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:setorial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import setoes, subsertores, segmentos, códigos e subsegmentos das empresas';

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
        $lines = file('/var/www/files/Setorial30012019.csv');

        $content = '';

        foreach ($lines as $line) {

            $line = trim($line);
            $line_parts = explode(';', $line);

            if (sizeof($line_parts) != 6) {
                $this->warn(implode(';', $line_parts));
                continue;
            }
                            
            $setor      = str_replace('"', '', trim($line_parts[0]));
            $subsetor   = str_replace('"', '', trim($line_parts[1]));
            $segmento   = str_replace('"', '', trim($line_parts[2]));
            $nome       = str_replace('"', '', trim($line_parts[3]));
            $codigo     = str_replace('"', '', trim($line_parts[4]));
            $subsegm    = str_replace('"', '', trim($line_parts[5]));

            $_setor = Setor::where('nome', $setor)->first();

            if (!$_setor) {
                $_setor = new Setor();
                $_setor->nome = $setor;
                $_setor->save();

                $this->info("  - " . $setor);
            }

            $_subsetor = Subsetor::where('nome', $subsetor)->where('setor_id', $_setor->id)->first();

            if (!$_subsetor) {
                $_subsetor = new Subsetor();
                $_subsetor->nome = $subsetor;
                $_subsetor->setor_id = $_setor->id;
                $_subsetor->save();

                $this->info("    - " . $subsetor);
            }

            $_segmento = Segmento::where('nome', $segmento)->where('subsetor_id', $_subsetor->id)->first();

            if (!$_segmento) {
                $_segmento = new Segmento();
                $_segmento->nome = $segmento;
                $_segmento->subsetor_id = $_subsetor->id;
                $_segmento->save();

                $this->info("      - " . $segmento);
            }

            $_empresa = Empresa::where('nome', $nome)->first();

            if (!$_empresa) {
                $_empresa = new Empresa();
                $_empresa->nome         = $nome;
                $_empresa->codigo       = $codigo;
                $_empresa->subsegmento  = $subsegm;
                $_empresa->segmento_id  = $_segmento->id;

                $_empresa->save();

                $this->info("        - " . $nome);
            }
        }
    }
}