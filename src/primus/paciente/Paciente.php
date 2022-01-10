<?php

namespace Paciente;
use Exception;
use Primus\IPersistencia;

class Paciente
{
    public $id;
    public $nomePaciente;
    public $dataNascimento;
    public $sexo;
    public $email;
    public $estadoCivil;
    public $cpf;
    public $profissao;

    private $pacientePersist;

    public function __construct(IPersistencia $pacientePersist)
    {
        $this->pacientePersist = $pacientePersist;
    }
    
    public function hidratarObjeto(array $paciente)
    {   
        $this->nomePaciente = (!empty($paciente['nomePaciente'])) ? $paciente['nomePaciente'] : '';
        $this->dataNascimento = (!empty($paciente['data'])) ? $paciente['data'] : ''; 
        $this->sexo = (!empty($paciente['sexo'])) ? $paciente['sexo'] : ''; 
        $this->email = (!empty($paciente['email'])) ? $paciente['email'] : ''; 
        $this->estadoCivil = (!empty($paciente['estadoCivil'])) ? $paciente['estadoCivil'] : ''; 
        $this->id = (!empty($paciente['id'])) ? $paciente['id'] : '';
        $this->cpf = (!empty($paciente['cpf'])) ? $paciente['cpf'] : '';
        $this->profissao = (!empty($paciente['profissao'])) ? $paciente['profissao'] : '';
    }
    
    public function getArray()
    {
        return [
            'nomePaciente' => $this->nomePaciente,
            'data' => $this->dataNascimento,
            'sexo' => $this->sexo,
            'email' => $this->email,
            'estadoCivil' => $this->estadoCivil,
            'id' => $this->id,
            'cpf' => $this->cpf,
            'profissao' =>$this->profissao
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

    public function save(Paciente $paciente)
    {
        try {
            $this->pacientePersist->save($paciente->getArray());
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