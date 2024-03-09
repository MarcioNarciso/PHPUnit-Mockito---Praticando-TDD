<?php

namespace App\Loja\FluxoDeCaixa;

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
    
    /**
     * Recebe um array de objetos que implementam AcaoAposGerarNotaInterface.
     * @param AcaoAposGerarNotaInterface[] $acoes
     */
    public function __construct(array $acoes = []) {
        $this->acoes = $acoes;
    }

    public function gerar(Pedido $pedido) 
    {
        $nf = new NotaFiscal($pedido->getCliente(), 
                             $pedido->getValorTotal() * 0.94, 
                             new \DateTime());
        
        foreach($this->acoes as $acao) {
            $acao->executar($nf);
        }
        
        return $nf;
    }
    
}
