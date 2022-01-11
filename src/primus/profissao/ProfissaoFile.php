<?php

namespace Profissao;

use Primus\File\Arquivo;
use Primus\IPersistencia;

class ProfissaoFile implements IPersistencia
{
    public $arquivo;
    public $diretorio = '../data/profissao/';

    public function __construct()
    {
        $this->arquivo = new Arquivo;
        $this->arquivo->setDiretorio($this->diretorio);
    }

    public function delet($id):bool
    {
        return $this->arquivo->delet($id);
    }

    public function save(array $dados):bool
    {
        $dados['id'] = (empty($dados['id'])) ? uniqid() : $dados['id'];
        return $this->arquivo->save($dados);
    }

    public function find($dadosProfissao):array
    {
        $arrDadosPaciente = [];
        $arrProfissaoTodosCadastros = $this->arquivo->getAll();

        foreach ($arrProfissaoTodosCadastros as $profissao) {

            $nomeProfissao = $this->arquivo->removerAcentos($profissao->nome);
            $dadosProfissaoSemAcentos = $this->arquivo->removerAcentos($dadosProfissao['dadosProfissao']);

            if (stristr($nomeProfissao, $dadosProfissaoSemAcentos) !== false) {
                $arrDadosPaciente[] = $profissao;
            }
        }
        
        return $arrDadosPaciente;
    }

    public function get($id):object
    {
        return $this->arquivo->get($id);
    }

    public function getAll():array
    {
        return $this->arquivo->getAll();
    }
}