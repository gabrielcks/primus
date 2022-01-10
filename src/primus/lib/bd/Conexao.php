<?php

namespace Primus\Lib\Bd;
use PDO;
use PDOException;

class Conexao 
{
    public function conect()
    {
        try {
            $arrDadosBd = include '../config/configBd.php';
            
            return new PDO(
                'mysql:host='.$arrDadosBd['host'].";dbname=".$arrDadosBd['bdName'],
                $arrDadosBd['user'],
                $arrDadosBd['password']
            );
        } catch (PDOException $e){
            echo 'FALHA NA CONEXÂO COM BANCO DE DADOS. ' . $e->getMessage();
            exit;
        }
    }
}