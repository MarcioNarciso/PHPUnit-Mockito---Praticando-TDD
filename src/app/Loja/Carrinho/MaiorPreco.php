<?php

namespace App\Loja\Carrinho;

/**
 * Description of MaiorPreco
 *
 * @author marcio
 */
class MaiorPreco {

    public function encontrar(CarrinhoDeCompras $carrinho) {
        if (count($carrinho->getProdutos()) === 0) {
            return 0;
        }
        
        $primeiroElemento = $carrinho->getProdutos()->offsetGet(0);
        $maiorValor = $primeiroElemento->getValorTotal();
        
        foreach($carrinho->getProdutos() as $produto) {
            if ($maiorValor < $produto->getValorTotal()) {
                $maiorValor = $produto->getValorTotal();
            }
        }
        
        return $maiorValor;
    }
    
}
