<?php

namespace App\Loja\RH;

/**
 *
 * @author marcio
 */
abstract class RegraDeCalculo {
        
    public function calcular(Funcionario $funcionario) {
        $salario = $funcionario->getSalario();
        
        if ($salario > $this->limite()) {
            return $salario * $this->porcentagemAcimaDoLimite();
        }

        return $salario * $this->porcentagemBase();
    }
    
    protected abstract function limite();
    
    protected abstract function porcentagemAcimaDoLimite();
    
    protected abstract function porcentagemBase();
}
