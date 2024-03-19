<?php

namespace App\Loja\Persistencia;

use PDO;

/**
 * Description of ConexaoFactory
 *
 * @author marcio
 */
class FabricaConexaoBD{

    public function criar() : \PDO
    {
        $conn = new \PDO('sqlite:/tmp/test.db');
            
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        return $conn;
    }
    
}
