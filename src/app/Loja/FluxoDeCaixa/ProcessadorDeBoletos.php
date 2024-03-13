<?php


namespace App\Loja\FluxoDeCaixa;

use ArrayObject;

/**
 * Description of ProcessadorDeBoletos
 *
 * @author marcio
 */
class ProcessadorDeBoletos {
    
    public function processar(ArrayObject $boletos, Fatura $fatura) 
    {
        $valorTotal = 0;
        
        foreach($boletos as $boleto) {
            $pagamento = new Pagamento($boleto->getValor(), MeioPagamento::BOLETO);
            
            $fatura->getPagamentos()->append($pagamento);
            
            $valorTotal += $boleto->getValor();
        }
        
        if ($valorTotal >= $fatura->getValor()) {
            $fatura->setPago(true);
        }
    }
    
}
