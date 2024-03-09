<?php

namespace App\Loja\FluxoDeCaixa;

use App\Exemplos\RelogioInterface;
use DateTime;

/**
 * Description of GeradorDeNotaFiscal
 *
 * @author marcio
 */
class GeradorDeNotaFiscal {
    
    /**
     * Array de objetos que implementam AcaoAposGerarNotaInterface.
     * @var AcaoAposGerarNotaInterface[]
     */
    private array $acoes;
    private RelogioInterface $relogio;
    
    /**
     * Recebe um array de objetos que implementam AcaoAposGerarNotaInterface.
     * @param AcaoAposGerarNotaInterface[] $acoes
     */
    public function __construct(array $acoes = [], RelogioInterface $relogio) {
        $this->acoes = $acoes;
        $this->relogio = $relogio;
    }

    public function gerar(Pedido $pedido) 
    {
        $nf = new NotaFiscal($pedido->getCliente(), 
                             $pedido->getValorTotal() * 0.94, 
                             $this->relogio->hoje());
        
        foreach($this->acoes as $acao) {
            $acao->executar($nf);
        }
        
        return $nf;
    }
    
}
