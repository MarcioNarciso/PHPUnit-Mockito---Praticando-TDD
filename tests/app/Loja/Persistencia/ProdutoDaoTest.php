<?php

namespace App\Loja\Persistencia;

use App\Loja\Produto\Produto;
use PHPUnit\Framework\TestCase;

/**
 * Description of ProdutoDaoTest
 *
 * @author marcio
 */
class ProdutoDaoTest extends TestCase
{
    private \PDO $conexao;
    
    protected function setUp() : void
    {
        parent::setUp();
        
        $this->conexao = (new FabricaConexaoBD())->criar();
        
        $this->criarTabela();
    }
    
    protected function criarTabela()
    {
        $sqlString = 'CREATE TABLE produto ';
        $sqlString .= '(id INTEGER PRIMARY KEY, nome TEXT, valor_unitario TEXT, quantidade TINYINT);';
        
        $this->conexao->query($sqlString);
    }

    protected function tearDown() : void
    {
        parent::tearDown();
        
        $sqlString = 'DROP TABLE produto';
        
        $this->conexao->query($sqlString);
        
        unlink('/tmp/test.db');
    }
    
    public function testDeveAdicionarUmProduto() 
    {
        $conn = (new FabricaConexaoBD())->criar();
        
        $produtoDao = new ProdutoDao($conn);
        
        $produto = new Produto('Geladeira', 150);
        
        $produtoDao->adicionar($produto);
        
        /**
         * Buscando pelo ID para verificar se está igual o produto do cenário.
         */
        $salvo = $produtoDao->porId($conn->lastInsertId());
        
        $this->assertEquals($salvo['nome'], $produto->getNome());
        
        $this->assertEquals($salvo['valor_unitario'], $produto->getValorUnitario());
        
        $this->assertEquals($salvo['quantidade'], $produto->getQuantidade());
    }
 
    public function testDeveFiltrarAtivos() 
    {
        $produtoDao = new ProdutoDao($this->conexao);
        
        $ativo = new Produto('Geladeira', 150, 1);
        $inativo = new Produto('Geladeira', 180, 1);
        
        $inativo->inativar();
        
        $produtoDao->adicionar($ativo);
        $produtoDao->adicionar($inativo);
        
        $produtosAtivos = $produtoDao->ativos();
        
        $this->assertEquals(1, count($produtosAtivos));
        
        $this->assertEquals(150, $produtosAtivos[0]['valor_unitario']);
    }
}
