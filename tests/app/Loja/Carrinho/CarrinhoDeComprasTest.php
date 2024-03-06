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
    
    public function testDeveAdicionarItens() 
    {
        $carrinho = $this->carrinhoBuilder->construir();
        
        // garante que o carrinho está vazio
        $this->assertEmpty($carrinho->getProdutos());
        
        $produto = new Produto("Geladeira", 900, 1);
        
        $carrinho->adicionar($produto);
        
        $esperado = count($carrinho->getProdutos());
        
        $this->assertEquals(1, $esperado);
        $this->assertEquals($produto, $carrinho->getProdutos()[0]);
    }
    
    public function testListaDeProdutos() 
    {
        $carrinho = $this->carrinhoBuilder
                        ->adicionarItens(200, 100)
                        ->construir();
        
        $this->assertEquals(2, count($carrinho->getProdutos()));
        $this->assertEquals(200.0, $carrinho->getProdutos()[0]->getValorUnitario());
        $this->assertEquals(100.0, $carrinho->getProdutos()[1]->getValorUnitario());
        
        // adicionar asserts nos outros atributos, como quantidade, etc.
        // e nos objetos dessa lista
    }
}
