<?php

namespace App\Loja\Carrinho;

use App\Loja\Produto\Produto;
use App\Loja\Test\Builder\CarrinhoDeComprasBuilder;

/**
 * Description of CarrinhoDeComprasTest
 *
 * @author marcio
 */
class CarrinhoDeComprasTest extends \PHPUnit\Framework\TestCase {

    private CarrinhoDeComprasBuilder $carrinhoBuilder;
    
    protected function setUp() : void
    {
        $this->carrinhoBuilder = new CarrinhoDeComprasBuilder();
        parent::setUp();
    }

    public function testDeveRetornarZeroSeCarrinhoVazio() 
    {
        $carrinho = $this->carrinhoBuilder->construir();
        
        $valor = $carrinho->maiorValor();
        
        $this->assertEquals(0, $valor);
    }
    
    public function testDeveRetornarValorDoItemSeCarrinhoCom1Elemento() 
    {
        $carrinho = $this->carrinhoBuilder
                        ->adicionarItens(900)
                        ->construir();

        $valor = $carrinho->maiorValor();
        
        $this->assertEquals(900, $valor);
    }
    
    public function testDeveRetornarMaiorValorSeCarrinhoComMuitosElementos() 
    {
        $carrinho = $this->carrinhoBuilder
                        ->adicionarItens(900, 1500, 750)
                        ->construir();
        
        $valor = $carrinho->maiorValor();
        
        $this->assertEquals(1500, $valor);
    }
}
