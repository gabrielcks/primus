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

    public function get($id)
    {      
        $this->pacientePersist->get($id);
        return $this->pacientePersist->get($id);
    }

    public function buscarTodos()
    {
        return $this->pacientePersist->getAll();
    }

    public function delete($id)
    {
        $this->pacientePersist->delet($id);
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

    public function buscar($dadosProfissao)
    {
       return $this->pacientePersist->find($dadosProfissao);
    }
}