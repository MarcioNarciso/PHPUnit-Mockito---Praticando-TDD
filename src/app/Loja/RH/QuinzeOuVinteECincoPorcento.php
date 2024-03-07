<?php

namespace App\Loja\RH;

/**
 * Description of QuinzeOuVinteECincoPorcento
 *
 * @author marcio
 */
class QuinzeOuVinteECincoPorcento extends RegraDeCalculo{
    
    protected function limite() {
        return 2500;
    }

    protected function porcentagemAcimaDoLimite() {
        return 0.75;
    }

    protected function porcentagemBase() {
        return 0.85;
    }
}
