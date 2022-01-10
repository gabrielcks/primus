<?php

namespace Profissao;
use Profissao\ProfissaoTable;
use Profissao\ProfissaoFile;
use stdClass;
use FFI\Exception;

class ProfissaoController
{
    public $bdProfissao;
    private $view = 'lista';

    public function __construct()
    {
        $this->viewData = new stdClass();
        $this->bdProfissao = new Profissao(new ProfissaoTable);
    }

    public function getView()
    {
        return $this->view;
    }

    public function listar()
    {
        $this->viewData->listaDeProfissao = $this->bdProfissao->buscarTodos();
    }

    public function buscar()
    {
        $dadosProfissao = $_REQUEST;
        $this->viewData->listaDeProfissao = $this->bdProfissao->buscar($dadosProfissao);
    }

    public function deletar()
    {
        $idNomeArquivo = $_GET['idProfissao'];
        if (!empty($idNomeArquivo)) {
            $this->bdProfissao->delete($idNomeArquivo);
        }
        return $this->listar();
    }

    public function carregarFormularioPreenchido()
    {
        $this->view = 'formProfissao';
        $dadosProfissao = $_REQUEST;
        $this->viewData->listaDeProfissao = $this->bdProfissao->get($dadosProfissao);
    }

    public function FormularioProfissao()
    {
        $this->view = 'formProfissao';
    }

    public function salvar()
    {
        $dadosProfissao = $_REQUEST;
        $this->bdProfissao->hidratarObjeto($dadosProfissao);

        try { 
            if ($this->bdProfissao->save($this->bdProfissao) != false) {
                $this->viewData->listaDeProfissao = $this->bdProfissao->buscarTodos();

            } else {
                throw new Exception('ERRO ao salvar paciente!');;
            } 

        } catch (Exception  $e) {
            echo $e->getMessage();    
        }
    }


}
