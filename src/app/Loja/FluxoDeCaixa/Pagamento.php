<?php

namespace App\Loja\FluxoDeCaixa;

/**
 * Description of Pagamento
 *
 * @author marcio
 */
class Pagamento 
{
    
    private $valor;
    private $meioPagamento;
    
    public function __construct($valor, $meioPagamento) {
        $this->valor = $valor;
        $this->meioPagamento = $meioPagamento;
    }

    public function getValor() {
        return $this->valor;
    }
}
