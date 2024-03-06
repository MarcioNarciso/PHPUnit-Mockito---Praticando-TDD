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
    
    public function testCalculoSalarioDesenvolvedoresComSalarioAcimaDoLimite() 
    {
        $desenvolvedor = new Funcionario("Andre", 4000, TabelaCargos::DESENVOLVEDOR);
        
        $salario = $this->calculadora->calcularSalario($desenvolvedor);
        
        $this->assertEquals(4000 * 0.8, $salario);
    }
    
    public function testDeveCalcularSalarioParaDBAsComSalarioAbaixoDoLimite() 
    {
        $dba = new Funcionario("Andre", 500.0, TabelaCargos::DBA);
        
        $salario = $this->calculadora->calcularSalario($dba);
        
        $this->assertEquals(500 * 0.85, $salario);
    }
    
    public function testDeveCalcularSalarioParaDBAsComSalarioAcimaDoLimite() 
    {
        $dba = new Funcionario("Mauricio", 4500.00, TabelaCargos::DBA);
        
        $salario = $this->calculadora->calcularSalario($dba);
        
        $this->assertEquals(4500.00 * 0.75, $salario);
    }
}
