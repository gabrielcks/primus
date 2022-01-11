<?php

namespace Primus\Lib\Bd;

abstract class TableGateWay
{
    protected $objPdo;
    private $conexao;
    
    public function __construct()
    {
        $this->conexao = new Conexao;
        $this->objPdo = $this->conexao->conect();

        if (is_a($this->objPdo, 'PDO') !== true) {
            print_r("ERRO!! conexão com o banco de dados, OBJ PDO com valor não esperado !! ");
            die;
        }
    }
}
