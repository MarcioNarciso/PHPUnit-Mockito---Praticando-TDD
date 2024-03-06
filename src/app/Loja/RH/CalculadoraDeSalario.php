<?php

namespace App\Loja\RH;

/**
 * Description of CalculadoraDeSalario
 *
 * @author marcio
 */
class CalculadoraDeSalario {
    
    public function calcularSalario(Funcionario $funcionario) : float
    {
        if ($funcionario->getCargo() == TabelaCargos::DESENVOLVEDOR) {
            return $this->dezOuVintePorcentoDeDesconto($funcionario);
        }
        
        if ($funcionario->getCargo() == TabelaCargos::DBA
                || $funcionario->getCargo() == TabelaCargos::TESTADOR) {
            return $this->quinzeOuVinteECincoPorcentoDeDesconto($funcionario);
        }
        
        throw new \Exception("Tipo de funcionário inválido.");
    }

    private function dezOuVintePorcentoDeDesconto($funcionario) {
        if ($funcionario->getSalario() > 3000) {
            return $funcionario->getSalario() * 0.8;
        }

        return $funcionario->getSalario() * 0.9;
    }

    private function quinzeOuVinteECincoPorcentoDeDesconto($funcionario) {
        if ($funcionario->getSalario() > 2500) {
            return $funcionario->getSalario() * 0.75;
        }

        return $funcionario->getSalario() * 0.85;
    }
}
