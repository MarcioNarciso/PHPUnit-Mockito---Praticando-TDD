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
        foreach($boletos as $boleto) {
            $pagamento = new Pagamento($boleto->getValor(), MeioPagamento::BOLETO);

            $fatura->adicionarPagamento($pagamento);
        }
    }
    
}
