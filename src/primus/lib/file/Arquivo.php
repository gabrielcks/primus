<?php

namespace Primus\File;
use \Primus\IPersistencia;

class Arquivo implements IPersistencia
{
    private $diretorio;
    
    public function delet($idNomeArquivo):bool
    {
        $arquivo = $this->getDiretorio().$idNomeArquivo;
 
        if (!file_exists($arquivo)) {
            return false;
        }
        return unlink($arquivo);
    }

    public function save(array $dados):bool
    {
        if (empty($dados)) {
            return false;
        }
        $json = json_encode($dados);
        return file_put_contents($this->getDiretorio().$dados['id'], $json);
    }

    public function get($idNomeArquivo):object
    {
        return json_decode(file_get_contents($this->getDiretorio().$idNomeArquivo));
    }

    public function getAll():array
    {
        {
            $arrDadosPaciente = [];
            $retornaDiretorio = dir($this->getDiretorio());
            while ($arquivo = $retornaDiretorio->read()) {
                if ($arquivo === "." || $arquivo === ".." || is_dir($this->getDiretorio().$arquivo)) {
                    continue;
                }
                
                $arrDadosPaciente[] = $this->get($arquivo);
            }
            $retornaDiretorio->close();
            return $arrDadosPaciente;
        }
    }

    public function find($dadosPaciente):array
    {
        $r =[];
        return $r;
    }

    public function getDiretorio()
    {
        return $this->diretorio;
    }

    public function setDiretorio($diretorio)
    {
        $this->diretorio = $diretorio;
    }


}
