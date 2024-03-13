<?php

namespace App\Loja\FluxoDeCaixa;

use ArrayObject;
use PHPUnit\Framework\TestCase;

/**
 * Description of ProcessadorDeBoletosTest
 *
 * @author marcio
 */
class ProcessadorDeBoletosTest extends TestCase
{
    private $processadorDeBoletos;
    
    protected function setUp() : void 
    {
        $this->processadorDeBoletos = new ProcessadorDeBoletos();
    }

    public function testDeveProcessarPagamentoViaBoletoUnico() 
    {
        $processadorDeBoletos = new ProcessadorDeBoletos();
        
        $fatura = new Fatura("Cliente", 150);
        $boleto = new Boleto(150);
        
        $boletos = new ArrayObject();
        $boletos->append($boleto);
        
        $processadorDeBoletos->processar($boletos, $fatura);
        
        $this->assertEquals(1, count($fatura->getPagamentos()));
        $this->assertEquals(150, $fatura->getPagamentos()[0]->getValor());
    }
    
    public function testDeveProcessarPagamentoViaMuitosBoletos() 
    {
        $processadorDeBoletos = new ProcessadorDeBoletos();
        
        $fatura = new Fatura('Cliente', 300);
        
        $boleto1 = new Boleto(100);
        $boleto2 = new Boleto(200);
        
        $boletos = new ArrayObject();
        $boletos->append($boleto1);
        $boletos->append($boleto2);
        
        $processadorDeBoletos->processar($boletos, $fatura);
        
        $this->assertEquals(2, count($fatura->getPagamentos()));
        
        $valor1 = $fatura->getPagamentos()[0]->getValor();
        $this->assertEquals(100, $valor1);
        
        $valor2 = $fatura->getPagamentos()[1]->getValor();
        $this->assertEquals(200, $valor2);
        
    }
    
    public function testDeveMarcarFaturaComoPagoCasoBoletoUnicoPagueTudo() 
    {
        $fatura = new Fatura('Cliente', 150);
        
        $boletos = new ArrayObject();
        $boletos->append(new Boleto(150));
        
        $this->processadorDeBoletos->processar($boletos, $fatura);
        
        $this->assertTrue($fatura->isPago());
    }
}
