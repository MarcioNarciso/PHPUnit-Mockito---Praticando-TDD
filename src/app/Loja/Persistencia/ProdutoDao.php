<?php

namespace App\Loja\Persistencia;

use App\Loja\Produto\Produto;
use PDO;

/**
 * Description of ProdutoDao
 *
 * @author marcio
 */
class ProdutoDao {
    
    private PDO $conexao;
    
    public function __construct(PDO $conexao) {
        $this->conexao = $conexao;
    }

    public function adicionar(Produto $produto) 
    {
        $sqlString = "INSERT INTO 'produto' ";
        $sqlString .= "(nome, valor_unitario, quantidade) ";
        $sqlString .= "VALUES (?, ?, ?)";
        
        $stmt = $this->conexao->prepare($sqlString);
        
        $nome = $produto->getNome();
        $valorUnitario = $produto->getValorUnitario();
        $quantidade = $produto->getQuantidade();
        
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $valorUnitario);
        $stmt->bindParam(3, $quantidade);
        
        $stmt->execute();
        
        return $this->conexao;
    }
    
    public function porId($id) 
    {
        $sqlString = "SELECT * FROM 'produto' WHERE id=".$id;
        
        $consulta = $this->conexao->query($sqlString);
        
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    
    public function ativos() 
    {
        $sqlString = "SELECT * FROM 'produto' WHERE quantidade > 0";
        
        $consulta = $this->conexao->query($sqlString);
        
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
