<?php

namespace Profissao;
use Exception;
use Primus\IPersistencia;

class Profissao
{
    public $profissao;
    public $id;
    public $status;
    private $pacientePersist;

    public function __construct(IPersistencia $pacientePersist)
    {
        $this->pacientePersist = $pacientePersist;
    }
    
    public function hidratarObjeto(array $profissao)
    {   
        $this->profissao = (!empty($profissao['nome'])) ? $profissao['nome'] : '';
        $this->id = (!empty($profissao['id'])) ? $profissao['id'] : '';
        $this->status = (!empty($profissao['status'])) ? $profissao['status'] : '';
    }
    
    public function getArray()
    {
        return [
            'nome' =>$this->profissao,
            'id' => $this->id,
            'status' => $this->status
        ];
    }

    public function get($idNomeArquivo)
    {       
        $this->pacientePersist->get($idNomeArquivo);
        return $this->pacientePersist->get($idNomeArquivo);
    }

    public function buscarTodos()
    {
        return $this->pacientePersist->getAll();
    }

    public function delete($idNomeArquivo)
    {
        $this->pacientePersist->delet($idNomeArquivo);
    }

    public function save(Profissao $profissao)
    {
        try {
            $this->pacientePersist->save($profissao->getArray());
            return true;

        } catch (Exception  $e) { 
            return false;  
        }
    }

    public function buscar($dadosPaciente)
    {
       return $this->pacientePersist->find($dadosPaciente);
    }
}