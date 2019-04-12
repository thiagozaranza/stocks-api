<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Empresa;
use App\Models\Indice;
use App\Models\Ativo;

class ImportEmpresasIndicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:empresas-indices';

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
        
        $lines = file('/var/www/files/AcoesIndices-JanAbr-2019.csv');

        $indices = [];

        $indices_line = array_shift($lines);

        $indices_line_parts = explode(';', $indices_line);

        foreach ($indices_line_parts as $codigo_indice) {
            
            $codigo_indice = trim($codigo_indice);

            if (!$codigo_indice)
                continue;
            
            $_indice = Indice::where('codigo', $codigo_indice)->first();

            if (!$_indice) 
                $this->warn($codigo_indice);
            
            $indices[$_indice->codigo] = $_indice->id;
        }   

        foreach ($lines as $line) {

            $line = trim($line);
            $line_parts = explode(';', $line);

            $empresa = trim($line_parts[0]);
            
            $_empresa = Empresa::where('nome', $empresa)->first();

            if (!$_empresa) {
                $this->warn($empresa);

                $_empresa = new Empresa();
                $_empresa->nome = $empresa;

                $i = 2;
                do {
                    $codigo_empresa = $line_parts[$i];
                    $i++;
                } while (!$codigo_empresa);

                $_empresa->codigo = substr($codigo_empresa, 0, 4);

                $_empresa->save();

                $this->warn($_empresa->codigo);
                //$_empresa->codigo = $empresa;
            }    
            //else     
            //    $this->info($empresa);

            $subsegmento = trim($line_parts[1]);

            if ($_empresa->subsegmento != $subsegmento) {
                $_empresa->subsegmento = $subsegmento;
                
                $_empresa->save();
            }   

            for ($i=2; $i<count($line_parts); $i++) {
                $codigo_ativo = $line_parts[$i];

                if (!$codigo_ativo)
                    continue;

                $_ativo = Ativo::where('codigo', $codigo_ativo)->first();

                if (!$_ativo) {
                    $ativo = new Ativo;
                    $ativo->codigo = $codigo_ativo;
                    $ativo->empresa_id = $_empresa->id;
                    $ativo->save(); 

                    //$this->info($ativo->codigo);
                }
                
            }

            $BDRX = trim($line_parts[2]);

            if ($BDRX) 
                $this->attachAtivoOnIndice($BDRX, 'BDRX');

            $IBOV = trim($line_parts[3]);
            if ($IBOV) 
                $this->attachAtivoOnIndice($IBOV, 'IBOV');
            
            $IBRA = trim($line_parts[4]);
            if ($IBRA) 
                $this->attachAtivoOnIndice($IBRA, 'IBRA');

            $IBXL = trim($line_parts[5]);
            if ($IBXL) 
                $this->attachAtivoOnIndice($IBXL, 'IBXL');

            $IBXX = trim($line_parts[6]);
            if ($IBXX) 
                $this->attachAtivoOnIndice($IBXX, 'IBXX');

            $ICO2 = trim($line_parts[7]);
            if ($ICO2) 
                $this->attachAtivoOnIndice($ICO2, 'ICO2');

            $ICON = trim($line_parts[8]);
            if ($ICON) 
                $this->attachAtivoOnIndice($ICON, 'ICON');

            $IDIV = trim($line_parts[9]);
            if ($IDIV) 
                $this->attachAtivoOnIndice($IDIV, 'IDIV');

            $IEEX = trim($line_parts[10]); 
            if ($IEEX) 
                $this->attachAtivoOnIndice($IEEX, 'IEEX');

            $IFIX = trim($line_parts[11]);
            if ($IFIX) 
                $this->attachAtivoOnIndice($IFIX, 'IFIX');

            $IFNC = trim($line_parts[12]);
            if ($IFNC) 
                $this->attachAtivoOnIndice($IFNC, 'IFNC');

            $IGCT = trim($line_parts[13]);
            if ($IGCT) 
                $this->attachAtivoOnIndice($IGCT, 'IGCT');

            $IGCX = trim($line_parts[14]);
            if ($IGCX) 
                $this->attachAtivoOnIndice($IGCX, 'IGCX');

            $IGNM = trim($line_parts[15]);
            if ($IGNM) 
                $this->attachAtivoOnIndice($IGNM, 'IGNM');

            $IMAT = trim($line_parts[16]);
            if ($IMAT) 
                $this->attachAtivoOnIndice($IMAT, 'IMAT');

            $IMOB = trim($line_parts[17]);
            if ($IMOB) 
                $this->attachAtivoOnIndice($IMOB, 'IMOB');

            $INDX = trim($line_parts[18]);
            if ($INDX) 
                $this->attachAtivoOnIndice($INDX, 'INDX');

            $ISEE = trim($line_parts[19]);
            if ($ISEE) 
                $this->attachAtivoOnIndice($ISEE, 'ISEE');

            $ITAG = trim($line_parts[20]);
            if ($ITAG) 
                $this->attachAtivoOnIndice($ITAG, 'ITAG');

            $IVBX = trim($line_parts[21]);
            if ($IVBX) 
                $this->attachAtivoOnIndice($IVBX, 'IVBX');
            
            $MLCX = trim($line_parts[22]);
            if ($MLCX) 
                $this->attachAtivoOnIndice($MLCX, 'MLCX');

            $SMLL = trim($line_parts[23]);
            if ($SMLL) 
                $this->attachAtivoOnIndice($SMLL, 'SMLL');

            $UTIL = trim($line_parts[24]);
            if ($UTIL) 
                $this->attachAtivoOnIndice($UTIL, 'UTIL');

        }

    }

    private function attachAtivoOnIndice($ativo, $indice)
    {
        $_ativo = Ativo::where('codigo', $ativo)->first();
        $_indice = Indice::where('codigo', $indice)->first();

        if (!$_indice->ativos()->get()->contains($_ativo)) {
            $_indice->ativos()->attach($_ativo->id);    
            //$this->info($_ativo->codigo . ' attached on ' . $_indice->codigo);
        }
    }
}