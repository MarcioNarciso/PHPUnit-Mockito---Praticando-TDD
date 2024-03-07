<?php

namespace App\Loja\RH;

/**
 * Description of QuinzeOuVinteECincoPorcento
 *
 * @author marcio
 */
class QuinzeOuVinteECincoPorcento implements RegraDeCalculo{
    
    public function calcular(Funcionario $funcionario) {
        if ($funcionario->getSalario() > 2500) {
            return $funcionario->getSalario() * 0.75;
        }

        return $funcionario->getSalario() * 0.85;;
    }
    
}
