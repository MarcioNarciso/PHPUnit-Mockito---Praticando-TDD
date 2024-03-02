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
        if ($funcionario->getCargo() === TabelaCargos::DESENVOLVEDOR) {
            if ($funcionario->getSalario() > 3000) {
                return 3200.0;
            }

            return 1350.0;
        }
        
        return 425.0;
    }
    
    
}
