<?php

namespace App\Loja\RH;

/**
 * Description of Funcionario
 *
 * @author marcio
 */
class Funcionario {
    
    protected $nome;
    protected $salario;
    protected $cargo;
    
    public function __construct($nome, $salario, $cargo) {
        $this->nome = $nome;
        $this->salario = $salario;
        $this->cargo = $cargo;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function getSalario() {
        return $this->salario;
    }

    public function getCargo() {
        return $this->cargo;
    }


}
