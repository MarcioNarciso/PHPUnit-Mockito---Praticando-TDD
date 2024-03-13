<?php

namespace App\Loja\FluxoDeCaixa;

/**
 * Description of Boleto
 *
 * @author marcio
 */
class Boleto {

    private $valor;
    
    public function __construct($valor) {
        $this->valor = $valor;
    }

    public function getValor() {
        return $this->valor;
    }
}
