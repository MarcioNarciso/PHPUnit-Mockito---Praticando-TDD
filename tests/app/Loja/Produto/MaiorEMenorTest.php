<?php

namespace App\Loja;

use PHPUnit\Framework\TestCase;

require "./vendor/autoload.php";

use App\Loja\Carrinho\CarrinhoDeCompras;
use App\Loja\Produto\{Produto, MaiorEMenor};

/**
 * Description of MaiorEMenorTest
 *
 * @author marcio
 */
class MaiorEMenorTest extends TestCase{
    
    public function testOrdemDecrescente() {
        $carrinho = new CarrinhoDeCompras();
        
        $carrinho->adicionar(new Produto("Geladeira", 450.00));
        $carrinho->adicionar(new Produto("Liquidificador", 250.00));
        $carrinho->adicionar(new Produto("Jogo de pratos", 70.00));
        
        $maiorMenor = new MaiorEMenor();
        $maiorMenor->encontrar($carrinho);
        
        $this->assertEquals("Jogo de pratos", $maiorMenor->getMenor()->getNome());
        $this->assertEquals("Geladeira", $maiorMenor->getMaior()->getNome());
    }
    
    public function testApenasUmProduto() {
        $carrinho = new CarrinhoDeCompras();
        
        $carrinho->adicionar(new Produto("Geladeira", 450.00));
        
        $maiorEMenor = new MaiorEMenor();
        $maiorEMenor->encontrar($carrinho);
        
        $this->assertEquals("Geladeira", $maiorEMenor->getMenor()->getNome());
        $this->assertEquals("Geladeira", $maiorEMenor->getMaior()->getNome());
    }
}
