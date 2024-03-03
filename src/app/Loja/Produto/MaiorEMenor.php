<?php

namespace App\Loja\Produto;

use App\Loja\Carrinho\CarrinhoDeCompras;

/**
 * Description of MaiorEMenor
 *
 * @author marcio
 */
class MaiorEMenor {

    private $menor;
    private $maior;
    
    public function encontrar(CarrinhoDeCompras $carrinho) 
    {
        foreach ($carrinho->getProdutos() as $produto) {
            if (empty($this->menor)
                    || $produto->getValorUnitario() < $this->menor->getValorUnitario()) {
                $this->menor = $produto;
            }
            
            if (empty($this->maior)
                    || $produto->getValorUnitario() > $this->maior->getValorUnitario()) {
                $this->maior = $produto;
            }
        }
    }
    
    public function getMenor() {
        return $this->menor;
    }
    
    public function getMaior() {
        return $this->maior;
    }
    
}
