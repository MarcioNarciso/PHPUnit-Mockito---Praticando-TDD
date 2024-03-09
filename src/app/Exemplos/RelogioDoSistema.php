<?php

namespace App\Exemplos;

/**
 * Description of RelogioDoSistema
 *
 * @author marcio
 */
class RelogioDoSistema implements RelogioInterface
{

    public function hoje() {
        return DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
    }
    
}
