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
            if ($funcionario->getSalario() > 3000) {
                return $funcionario->getSalario() * 0.8;
            }

            return $funcionario->getSalario() * 0.9;
        }
        
        if ($funcionario->getCargo() == TabelaCargos::DBA) {
            if ($funcionario->getSalario() > 2500) {
                return $funcionario->getSalario() * 0.75;
            }

            return $funcionario->getSalario() * 0.85;
        }
        
        throw new \Exception("Tipo de funcionário inválido.");
    }
    
    
}
