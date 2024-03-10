<?php
namespace App\Loja\FluxoDeCaixa;

use App\Exemplos\RelogioDoSistema;
use App\Loja\Tributos\TabelaInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Description of GeradorDeNotaFiscalTest
 *
 * @author marcio
 */
class GeradorDeNotaFiscalTest extends TestCase 
{
    private NFdao $dao;
    private SAP $sap;
    private TabelaInterface $tabela;
    
    protected function setUp() : void 
    {
        $this->dao = Mockery::mock("App\Loja\FluxoDeCaixa\NFDao");
        $this->dao->shouldReceive("executar")->andReturn(true);   
        
        $this->sap = Mockery::mock("App\Loja\FluxoDeCaixa\SAP");
        $this->sap->shouldReceive("executar")->andReturn(true);
        
        $this->tabela = Mockery::mock("App\Loja\Tributos\TabelaInterface");
        $this->tabela->shouldReceive("paraValor")->with(1000)->andReturn(0.2);
        
        parent::setUp();
    }
    
    public function testDeveInvocarAcoesPosteriores()
    {
        $acao1 = Mockery::mock("App\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface");
        $acao1->shouldReceive("executar")->andReturn(true);
        
        $acao2 = Mockery::mock("App\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface");
        $acao2->shouldReceive("executar")->andReturn(true);
        
        $gerador = new GeradorDeNotaFiscal([$acao1, $acao2], new RelogioDoSistema(), $this->tabela);
        $pedido = new Pedido("Andre", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertTrue($acao1->executar($nf));
        $this->assertTrue($acao2->executar($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf("App\Loja\FluxoDeCaixa\NotaFiscal", $nf);
    }

    public function testDeveGerarNFComValorDeImpostoDescontado() 
    {
        $gerador = new GeradorDeNotaFiscal([], new RelogioDoSistema(), $this->tabela);
        
        $pedido = new Pedido("André", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertEquals(1000 * 0.8, $nf->getValor());
    }
    
    public function testDevePersistirNFGerada() 
    {
        $gerador = new GeradorDeNotaFiscal([$this->dao], new RelogioDoSistema(), $this->tabela);
        $pedido = new Pedido("Andre", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertTrue($this->dao->executar($nf));
        $this->assertNotNull($nf);
        $this->assertEquals(1000 * 0.8, $nf->getValor());
    }
    
    public function testDeveEnviarNFGeradaParaSAP() 
    {
        $gerador = new GeradorDeNotaFiscal([$this->sap], new RelogioDoSistema(), $this->tabela);
        $pedido = new Pedido("Andre", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertTrue($this->sap->executar($nf));
        $this->assertEquals(1000 * 0.8, $nf->getValor());
    }
    
    public function testDeveConsultarATabelaParaCalcularValor() 
    {
        // dublando uma tabela
        $tabela = Mockery::mock("App\Loja\Tributos\TabelaInterface");
        
        // definindo o futuro comportamento "paraValor",
        // que deve retornar 0.2 caso o valor seja 1000.0
        $tabela->shouldReceive("paraValor")
                ->with(1000)->andReturn(0.2);
        
        $gerador = new GeradorDeNotaFiscal([], new RelogioDoSistema(), $tabela);
        $pedido = new Pedido("André", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        // garantindo que a tabela foi consultada
        $this->assertEquals(1000.0 * 0.8, $nf->getValor());
        
    }
}
