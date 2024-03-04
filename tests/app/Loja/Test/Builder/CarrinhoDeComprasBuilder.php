<?php

namespace App\Loja\Test\Builder;

use App\Loja\Carrinho\CarrinhoDeCompras;
use App\Loja\Produto\Produto;

/**
 * Description of CarrinhoDeComprasBuilder
 *
 * @author marcio
 */
class CarrinhoDeComprasBuilder {

    private CarrinhoDeCompras $carrinho;
    
    public function __construct() {
        $this->carrinho = new CarrinhoDeCompras();
    }
    
    public function adicionarItens(float ...$valores) {
        foreach($valores as $valor) {
            $this->carrinho->adicionar(new Produto("Item", $valor, 1));
        }
        
        return $this;
    }
    
    public function construir() : CarrinhoDeCompras
    {
        return $this->carrinho;
    }
}
