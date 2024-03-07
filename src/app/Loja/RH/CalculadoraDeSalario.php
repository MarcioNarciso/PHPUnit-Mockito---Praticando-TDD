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
        $cargo = new Cargo($funcionario->getCargo());
        
        return $cargo->getRegra()->calcular($funcionario);
    }
}
