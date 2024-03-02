<?php

namespace App\Exemplos;

use App\Exemplos\ConversorDeNumeroRomano;

/**
 * Description of ConversorDeNumeroRomanoTest
 *
 * @author marcio
 */
class ConversorDeNumeroRomanoTest extends \PHPUnit\Framework\TestCase{

    public function testDeveEntenderOSimboloI() 
    {
        $conversor = new ConversorDeNumeroRomano();
        $numero = $conversor->converter("I");
        
        $this->assertEquals(1, $numero);
    }
    
    public function testDeveEntenderOSimboloV() 
    {
        $conversor = new ConversorDeNumeroRomano();
        $numero = $conversor->converter("V");
        
        $this->assertEquals(5, $numero);
    }
    
    public function testDeveEndenterOSimboloII() {
        $conversor = new ConversorDeNumeroRomano();
        $numero = $conversor->converter("II");
        
        $this->assertEquals(2, $numero);
    }
    
    public function testDeveEntenderOSimboloXXII() {
        $conversor = new ConversorDeNumeroRomano();
        $numero = $conversor->converter("XXII");
        
        $this->assertEquals(22, $numero);
    }
    
    public function testDeveEntenderOSimboloIX() {
        $conversor = new ConversorDeNumeroRomano();
        $numero = $conversor->converter("IX");
        
        $this->assertEquals(9, $numero);
    }
}
