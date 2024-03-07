<?php

namespace App\Loja\RH;

/**
 * Description of DezOuVintePorcento
 *
 * @author marcio
 */
class DezOuVintePorcento implements RegraDeCalculo{

    public function calcular(Funcionario $funcionario) {
        if ($funcionario->getSalario() > 3000) {
            return $funcionario->getSalario() * 0.8;
        }

        return $funcionario->getSalario() * 0.9;
    }
    
}
