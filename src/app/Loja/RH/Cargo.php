<?php

namespace App\Loja\RH;

/**
 * Description of Cargo
 *
 * @author marcio
 */
class Cargo {
    
    private $cargos = [
        TabelaCargos::DESENVOLVEDOR => 'App\Loja\RH\DezOuVintePorcento',
        TabelaCargos::DBA => 'App\Loja\RH\QuinzeOuVinteECincoPorcento',
        TabelaCargos::TESTADOR => 'App\Loja\RH\QuinzeOuVinteECincoPorcento'
    ];
    
    private $regra;
    
    public function __construct($regra) {
        if (empty($this->cargos[$regra])) {
            throw new \Exception('Cargo inválido');
        }
        
        $this->regra = $this->cargos[$regra];
    }
    
    public function getRegra() {
        return new $this->regra();
    }
}
