<?php
namespace App\Loja\FluxoDeCaixa;

/**
 * Description of GeradorDeNotaFiscalTest
 *
 * @author marcio
 */
class GeradorDeNotaFiscalTest extends \PHPUnit\Framework\TestCase {

    public function testDeveGerarNFComValorDeImpostoDescontado() 
    {
        $gerador = new GeradorDeNotaFiscal();
        
        $pedido = new Pedido("André", 1000, 1);
        
        $nf = $gerador->gerar($pedido);
        
        $this->assertEquals(1000 * 0.94, $nf->getValor());
    }
    
}
