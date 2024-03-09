<?php
namespace App\Loja\FluxoDeCaixa;

use Mockery;

/**
 * Description of GeradorDeNotaFiscalTest
 *
 * @author marcio
 */
class GeradorDeNotaFiscalTest extends \PHPUnit\Framework\TestCase 
{
    private NFdao $dao;
    private SAP $sap;
    
    protected function setUp() : void 
    {
        $this->dao = Mockery::mock("App\Loja\FluxoDeCaixa\NFDao");
        $this->dao->shouldReceive("persistir")->andReturn(true);   
        
        $this->sap = Mockery::mock("App\Loja\FluxoDeCaixa\SAP");
        $this->sap->shouldReceive("enviar")->andReturn(true);
        
        parent::setUp();
    }

    public function testDeveGerarNFComValorDeImpostoDescontado() 
    {
        $gerador = new GeradorDeNotaFiscal($this->dao, $this->sap);
        
        $pedido = new Pedido("André", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertEquals(1000 * 0.94, $nf->getValor());
    }
    
    public function testDevePersistirNFGerada() 
    {
        $gerador = new GeradorDeNotaFiscal($this->dao, $this->sap);
        $pedido = new Pedido("Andre", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertTrue($this->dao->persistir($nf));
        $this->assertNotNull($nf);
        $this->assertEquals(1000 * 0.94, $nf->getValor());
    }
    
    public function testDeveEnviarNFGeradaParaSAP() 
    {
        $gerador = new GeradorDeNotaFiscal($this->dao, $this->sap);
        $pedido = new Pedido("Andre", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertTrue($this->sap->enviar($nf));
        $this->assertEquals(1000 * 0.94, $nf->getValor());
    }
}
