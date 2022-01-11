<?php

namespace Profissao;
use Profissao\ProfissaoTable;
use Profissao\ProfissaoFile;
use stdClass;
use Exception;

class ProfissaoController
{
    public $profissao;
    private $view = 'lista';

    public function __construct()
    {
        $this->viewData = new stdClass();
        $this->profissao = new Profissao(new ProfissaoTable);
    }

    public function getView()
    {
        return $this->view;
    }

    public function listar()
    {
        $this->viewData->listaDeProfissao = $this->profissao->buscarTodos();
    }

    public function buscar()
    {
        $dadosProfissao = $_REQUEST;
        $this->viewData->listaDeProfissao = $this->profissao->buscar($dadosProfissao);
    }

    public function deletar()
    {
        $idNomeArquivo = $_GET['idProfissao'];
        if (!empty($idNomeArquivo)) {
            $this->profissao->delete($idNomeArquivo);
        }
        return $this->listar();
    }

    public function carregarFormularioPreenchido()
    {
        $this->view = 'formProfissao';
        $idProfissao = filter_var($_REQUEST['nomeDoArquivo'], FILTER_SANITIZE_STRING);
        $this->viewData->listaDeProfissao = $this->profissao->get($idProfissao);
    }

    public function FormularioProfissao()
    {
        $this->view = 'formProfissao';
    }

    public function salvar()
    {
        $dadosProfissao = $_REQUEST;
        $this->profissao->hidratarObjeto($dadosProfissao);

        try { 
            if (!$this->profissao->save($this->profissao)) {
                throw new Exception('ERRO ao salvar paciente!'); 
            }

            $this->viewData->listaDeProfissao = $this->profissao->buscarTodos();

        } catch (Exception  $e) {
            echo $e->getMessage();    
        }
    }


}
