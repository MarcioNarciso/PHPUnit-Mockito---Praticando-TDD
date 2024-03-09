<?php

namespace App\Loja\FluxoDeCaixa;

/**
 * Description of GeradorDeNotaFiscal
 *
 * @author marcio
 */
class GeradorDeNotaFiscal {
    
    private NFDao $dao;
    private SAP $sap;
    
    public function __construct(NFdao $dao, SAP $sap) {
        $this->dao = $dao;
        $this->sap = $sap;
    }

        public function gerar(Pedido $pedido) 
    {
        $nf = new NotaFiscal($pedido->getCliente(), 
                             $pedido->getValorTotal() * 0.94, 
                             new \DateTime());
        
        if ($this->dao->persistir($nf) 
                && $this->sap->enviar($nf)) {
            return $nf;
        }
        
        return null;
    }
    
}
