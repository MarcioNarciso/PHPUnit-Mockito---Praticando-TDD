<?php

namespace App\Exemplos;

/**
 * Description of ConversorDeNumeroRomano
 *
 * @author marcio
 */
class ConversorDeNumeroRomano {
    
    protected $tabela = [
        "I" => 1,
        "V" => 5,
        "X" => 10,
        "L" => 50,
        "C" => 100,
        "D" => 500,
        "M" => 1000
    ];
    
    public function converter($numeroRomano) {
        
        $acumulador = 0;
        $numAnterior = 0;
        
        // Percorre os símbolos do numeral romano inversamente
        for($i=strlen($numeroRomano)-1; $i>=0; $i--) 
        {
            // símbolo romano a ser analizado
            $simboloCorrente = $numeroRomano[$i];
            // valor em decimal correspondente ao símbolo
            $numCorrente = $this->tabela[$simboloCorrente] ?? 0; 
            
            // Se o valor do símbolo atual for menor que o do símbolo anterior,
            // o valor é subtraído do montante. Caso contrário, é somado.
            $multiplicador = $numCorrente < $numAnterior ? -1 : 1;
            $acumulador += ($multiplicador * $numCorrente);
            
            // Atualiza o valor do símbolo anterior para a próx. iteração
            $numAnterior = $numCorrente;
        }
        
        return $acumulador;
    }
    
}
