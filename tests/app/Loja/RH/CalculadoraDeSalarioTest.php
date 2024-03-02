<?php

namespace App\Loja\RH;

/**
 * Description of CalculadoraDeSalarioTest
 *
 * @author marcio
 */
class CalculadoraDeSalarioTest extends \PHPUnit\Framework\TestCase
{

    private CalculadoraDeSalario $calculadora;
    
    protected function setUp() : void {
        $this->calculadora = new CalculadoraDeSalario();
    }
    
    
    
    public function testCalculoSalarioDesenvolvedoresComSalarioAbaixoDoLimite() 
    {
        $desenvolvedor = new Funcionario("Andre", 1500.0, TabelaCargos::DESENVOLVEDOR);
        
        $salario = $this->calculadora->calcularSalario($desenvolvedor);
        
        $this->assertEquals(1500.0 * 0.9, $salario);
    }
    
}
