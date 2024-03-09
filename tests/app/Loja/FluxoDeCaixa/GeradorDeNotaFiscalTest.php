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
        $this->dao->shouldReceive("executar")->andReturn(true);   
        
        $this->sap = Mockery::mock("App\Loja\FluxoDeCaixa\SAP");
        $this->sap->shouldReceive("executar")->andReturn(true);
        
        parent::setUp();
    }
    
    public function testDeveInvocarAcoesPosteriores()
    {
        $acao1 = Mockery::mock("App\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface");
        $acao1->shouldReceive("executar")->andReturn(true);
        
        $acao2 = Mockery::mock("App\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface");
        $acao2->shouldReceive("executar")->andReturn(true);
        
        $gerador = new GeradorDeNotaFiscal([$acao1, $acao2]);
        $pedido = new Pedido("Andre", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertTrue($acao1->executar($nf));
        $this->assertTrue($acao2->executar($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf("App\Loja\FluxoDeCaixa\NotaFiscal", $nf);
    }

    public function testDeveGerarNFComValorDeImpostoDescontado() 
    {
        $gerador = new GeradorDeNotaFiscal();
        
        $pedido = new Pedido("André", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertEquals(1000 * 0.94, $nf->getValor());
    }
    
    public function testDevePersistirNFGerada() 
    {
        $gerador = new GeradorDeNotaFiscal([$this->dao]);
        $pedido = new Pedido("Andre", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertTrue($this->dao->executar($nf));
        $this->assertNotNull($nf);
        $this->assertEquals(1000 * 0.94, $nf->getValor());
    }
    
    public function testDeveEnviarNFGeradaParaSAP() 
    {
        $gerador = new GeradorDeNotaFiscal([$this->sap]);
        $pedido = new Pedido("Andre", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertTrue($this->sap->executar($nf));
        $this->assertEquals(1000 * 0.94, $nf->getValor());
    }
}
