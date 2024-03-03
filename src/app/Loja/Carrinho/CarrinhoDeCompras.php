<?php

namespace App\Loja\Carrinho;

use App\Loja\Produto\Produto;


class CarrinhoDeCompras {
    
    private $produtos;
    
    public function __construct() {
        $this->produtos = new \ArrayObject();
    }
    
    public function adicionar(Produto $produto) {
        $this->produtos->append($produto);
        return $this;
    }
    
    public function getProdutos() {
        return $this->produtos;
    }
    
    public function maiorValor() {
        if (count($this->getProdutos()) === 0) {
            return 0;
        }
        
        $primeiroElemento = $this->getProdutos()->offsetGet(0);
        $maiorValor = $primeiroElemento->getValorTotal();
        
        foreach($this->getProdutos() as $produto) {
            if ($maiorValor < $produto->getValorTotal()) {
                $maiorValor = $produto->getValorTotal();
            }
        }
        
        return $maiorValor;
    }
}
