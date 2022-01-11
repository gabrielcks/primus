<?php

namespace Paciente;
use Paciente\Paciente;
use stdClass;
use Exception;
use Paciente\PacienteFile;
use Paciente\PacienteTable;
use Profissao\ProfissaoController;
use Profissao\ProfissaoTable;

class PacienteController
{
    private $view = 'lista';
    private $paciente;
    public $acao;
    public $viewData;
    public $profissao;

    public function __construct()
    {
        $this->viewData = new stdClass();
        $this->paciente = new Paciente(new PacienteFile);
        $this->profissao = new ProfissaoTable;;
    }

    public function getView()
    {
        return $this->view;
    }

    public function buscar()
    {
        $nomeDoPaciente = $_GET['dadosPaciente'];
        if (!empty($nomeDoPaciente)) {
            $this->viewData->listaDePacientes = $this->paciente->buscar($nomeDoPaciente);
        }
    }

    public function carregarFormularioPreenchido()
    {
        $this->view = 'form';
        $idNomeArquivo = $_GET['nomeDoArquivo'];
        if (!empty($idNomeArquivo)) {
            $this->viewData->paciente = $this->paciente->get($idNomeArquivo);
            $this->viewData->profissao = $this->profissao->getAll();
        }  
    }
    
    public function carregarFormulario()
    {
        $this->view = 'form';
        $this->viewData->profissao = $this->profissao->getAll();
    }

    public function FormularioProfissao()
    {
        $this->view ='../profissao/formProfissao';
    }

    public function salvar()
    {
        $dadosPaciente = $_REQUEST;
        $this->paciente->hidratarObjeto($dadosPaciente);
        $pacienteValidate = new PacienteValidate($this->paciente);
    
        try { 
            $pacienteValidate->rodarValidacao();
            if ($this->paciente->save($this->paciente) != false) {
                $this->viewData->listaDePacientes = $this->paciente->buscarTodos();

            } else {
                throw new Exception('ERRO ao salvar paciente!');;
            } 

        } catch (Exception  $e) {
            echo $e->getMessage();    
        }
    }

    public function listar()
    {
        $this->viewData->listaDePacientes = $this->paciente->buscarTodos();
    }

    public function deletar()
    {   
        $idNomeArquivo = $_GET['nomeDoArquivo'];

        if (!empty($idNomeArquivo)) {
            $this->paciente->delete($idNomeArquivo);
        }
        return $this->listar();
    }
}