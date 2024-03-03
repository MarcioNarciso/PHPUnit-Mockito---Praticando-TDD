<?php

namespace App\Loja\Carrinho;

use App\Loja\Produto\Produto;

/**
 * Description of CarrinhoDeComprasTest
 *
 * @author marcio
 */
class CarrinhoDeComprasTest extends \PHPUnit\Framework\TestCase {

    private CarrinhoDeCompras $carrinho;
    
    protected function setUp() : void
    {
        $this->carrinho = new CarrinhoDeCompras();
    }

    public function testDeveRetornarZeroSeCarrinhoVazio() 
    {
        $valor = $this->carrinho->maiorValor();
        
        $this->assertEquals(0, $valor);
    }
    
    public function testDeveRetornarValorDoItemSeCarrinhoCom1Elemento() 
    {
        $this->carrinho->adicionar(new Produto("Geladeira", 900, 1));
        
        $valor = $this->carrinho->maiorValor();
        
        $this->assertEquals(900, $valor);
    }
    
    public function testDeveRetornarMaiorValorSeCarrinhoComMuitosElementos() 
    {
        $this->carrinho->adicionar(new Produto("Geladeira", 900, 1));
        $this->carrinho->adicionar(new Produto("Fogão", 1500, 1));
        $this->carrinho->adicionar(new Produto("Máquina de Lavar", 750, 1));
        
        $valor = $this->carrinho->maiorValor();
        
        $this->assertEquals(1500, $valor);
    }
}
