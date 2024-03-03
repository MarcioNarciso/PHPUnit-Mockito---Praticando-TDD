<?php

namespace App\Loja\Carrinho;

use App\Loja\Produto\Produto;

/**
 * Description of MaiorPrecoTest
 *
 * @author marcio
 */
class MaiorPrecoTest extends \PHPUnit\Framework\TestCase
{
    private CarrinhoDeCompras $carrinho;

    protected function setUp() : void 
    {
        $this->carrinho = new CarrinhoDeCompras();
    }

    public function testDeveRetornarZeroSeCarrinhoVazio() 
    {
        $algoritmo = new MaiorPreco();
        
        $valor = $algoritmo->encontrar($this->carrinho);
        
        $this->assertEquals(0, $valor);
    }
    
    public function testDeveRetornarValorDoItemSeCarrinhoCom1Elemento() 
    {
        $this->carrinho->adicionar(new Produto("Geladeira", 1, 900));
        
        $algoritmo = new MaiorPreco();
        $valor = $algoritmo->encontrar($this->carrinho);
        
        $this->assertEquals(900, $valor);
    }
    
    public function testDeveRetornarMaiorValorSeCarrinhoComMuitosElementos() 
    {
        $this->carrinho->adicionar(new Produto("Geladeira", 1, 900));
        $this->carrinho->adicionar(new Produto("Fogão", 1, 1500));
        $this->carrinho->adicionar(new Produto("Máquina de lavar", 1, 750));
        
        $algoritmo = new MaiorPreco();
        $valor = $algoritmo->encontrar($this->carrinho);
        
        $this->assertEquals(1500, $valor);
    }
}
