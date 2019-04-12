<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\TesouroCategoria;
use App\Models\TesouroTipo;
use App\Models\TesouroTitulo;
use App\Models\TesouroCotacao;

class ImportTesouroCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tesouro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import informações sobre tesouro direto';

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
        
        $this->importCategorias();
        $this->importTipos();
        $this->importHistorico();
    }

    private function importHistorico()
    {
        $path = '/var/www/files/tesouro/historico/';

        foreach (scandir($path) as $filename) {

            if ($filename == '.' || $filename == '..')
                continue;

            $filename_parts = explode('_', $filename);

            if (sizeof($filename_parts) < 2)
                continue;

            $tipo       = $filename_parts[0];
            $vencimento = $filename_parts[1];

            $_tipo = TesouroTipo::where('codigo', $tipo)->first();

            if (!$_tipo) {
                $this->error("Tipo não identificado: " . $tipo);
                exit;
            }

            $dia_vencimento = substr($vencimento, 0, 2);
            $mes_vencimento = substr($vencimento, 2, 2);
            $ano_vencimento = substr($vencimento, 4, 2);

            $titulo_nome = $_tipo->nome . ' ' . $ano_vencimento;

            $_titulo = TesouroTitulo::where('nome', $titulo_nome)->first();

            if (!$_titulo) {

                $_titulo = new TesouroTitulo();
                $_titulo->nome = $titulo_nome;
                $_titulo->data_vencimento = '20'.$ano_vencimento.'-'.$mes_vencimento.'-'.$dia_vencimento;
                $_titulo->tipo_id = $_tipo->id;
                $_titulo->save();

                //$this->info("Título : " . $titulo_nome);
            }

            $lines = file($path . $filename);

            foreach ($lines as $line) {

                $line = trim($line);
                $line_parts = explode(';', $line);

                if (sizeof($line_parts) != 6 || $line_parts[1] == '')
                    continue;
                
                $data           = $line_parts[0];
                $taxa_compra    = str_replace('%', '', str_replace(',', '.', $line_parts[1]));
                $taxa_venda     = str_replace('%', '', str_replace(',', '.', $line_parts[2]));
                $preco_compra   = str_replace(',', '.', str_replace('.', '', $line_parts[3]));
                $preco_venda    = str_replace(',', '.', str_replace('.', '', $line_parts[4]));
                $preco_base     = str_replace(',', '.', str_replace('.', '', $line_parts[5]));

                $data_parts = explode('/', $data);

                if (sizeof($data_parts) != 3)
                    continue;

                $data = $data_parts[2].'-'.$data_parts[1].'-'.$data_parts[0];

                $_cotacao = TesouroCotacao::where('titulo_id', $_titulo->id)->where('data', $data)->first();
                
                if (!$_cotacao) {

                    $_cotacao = new TesouroCotacao();
                    $_cotacao->titulo_id    = $_titulo->id;
                    $_cotacao->data         = $data;
                    $_cotacao->taxa_compra  = ($taxa_compra)? $taxa_compra : null;
                    $_cotacao->taxa_venda   = ($taxa_venda)? $taxa_compra : null;
                    $_cotacao->preco_compra = ($preco_compra)? $taxa_compra : null;
                    $_cotacao->preco_venda  = ($preco_venda)? $taxa_compra : null;
                    $_cotacao->preco_base   = ($preco_base)? $taxa_compra : null;

                    $_cotacao->save();
    
                    //$this->info("Cotacao : " . $data . ' ' . $taxa_compra);
                }
            }
        }
    }

    private function importCategorias()
    {
        $lines = file('/var/www/files/tesouro/Categorias.csv');

        foreach ($lines as $line) {

            $nome = trim($line);
            
            $_categoria = TesouroCategoria::where('nome', $nome)->first();

            if (!$_categoria) {

                $_categoria = new TesouroCategoria();
                $_categoria->nome = $nome;
                $_categoria->save();

                //$this->info("Categoria : " . $nome);
            }
        }
    }

    private function importTipos()
    {
        $lines = file('/var/www/files/tesouro/Tipos.csv');

        foreach ($lines as $line) {

            $line = trim($line);
            $line_parts = explode(';', $line);

            if (sizeof($line_parts) != 3) {
                $this->warn(implode(';', $line_parts));
                continue;
            }

            $codigo     = trim($line_parts[0]);
            $categoria  = trim($line_parts[1]);
            $nome       = trim($line_parts[2]);
            
            $_categoria = TesouroCategoria::where('nome', $categoria)->first();

            if (!$_categoria) {
                $this->error("Categoria não identificada: " . $categoria);
                exit;
            }

            $_tipo = TesouroTipo::where('codigo', $codigo)->first();

            if (!$_tipo) {

                $_tipo = new TesouroTipo();
                $_tipo->nome = $nome;
                $_tipo->codigo = $codigo;
                $_tipo->categoria_id = $_categoria->id;
                $_tipo->save();

                //$this->info("Tipo : " . $codigo);
            }
        }
    }
}