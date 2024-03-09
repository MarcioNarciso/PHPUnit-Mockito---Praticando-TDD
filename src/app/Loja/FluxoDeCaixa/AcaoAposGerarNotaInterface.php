<?php

namespace App\Loja\FluxoDeCaixa;

/**
 *
 * @author marcio
 */
interface AcaoAposGerarNotaInterface {

    public function executar(NotaFiscal $nf);
    
}
