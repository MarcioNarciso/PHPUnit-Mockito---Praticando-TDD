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
        if ($funcionario->getSalario() > 3000) {
            return $funcionario->getSalario() * 0.8;
        }
        
        return $funcionario->getSalario() * 0.9;
    }
    
    
}
