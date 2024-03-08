<?php

namespace App\Loja\FluxoDeCaixa;

/**
 * Description of GeradorDeNotaFiscal
 *
 * @author marcio
 */
class GeradorDeNotaFiscal {

    public function gerar(Pedido $pedido) {
        return new NotaFiscal($pedido->getCliente(), 
                              $pedido->getValorTotal() * 0.94, 
                              new \DateTime());
    }
    
}
