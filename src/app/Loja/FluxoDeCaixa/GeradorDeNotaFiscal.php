<?php

namespace App\Loja\FluxoDeCaixa;

use App\Exemplos\RelogioInterface;
use App\Loja\Tributos\TabelaInterface;

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
    public function __construct(array $acoes = [], RelogioInterface $relogio,
                                TabelaInterface $tabela) {
        $this->acoes = $acoes;
        $this->relogio = $relogio;
        $this->tabela = $tabela;
    }

    public function gerar(Pedido $pedido) 
    {
        $valorTabela = $this->tabela->paraValor($pedido->getValorTotal());
        
        $valorTotal = $pedido->getValorTotal() - ($pedido->getValorTotal() * $valorTabela);
        
        $nf = new NotaFiscal($pedido->getCliente(), $valorTotal, $this->relogio->hoje());
        
        foreach($this->acoes as $acao) {
            $acao->executar($nf);
        }
        
        return $nf;
    }
    
}
