<?php

namespace Paciente;

use Primus\File\Arquivo;
use Primus\IPersistencia;

class PacienteFile implements IPersistencia
{
    public $arquivo;
    public $diretorio = '../data/pacientes/';

    public function __construct()
    {
        $this->arquivo = new Arquivo;
        $this->diretorio = $this->arquivo->setDiretorio($this->diretorio);
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

    public function find($dadosPaciente):array
    {
        $arrDadosPaciente = [];
        $data = explode("/",$dadosPaciente);
        $data = $data[2] . '-' . $data[1] . '-' . $data[0];
        $arrPacientesTodosCadastros = $this->arquivo->getAll();

        foreach ($arrPacientesTodosCadastros as $paciente) {

            if (stristr($paciente->data, $data) !== false) {
                $arrDadosPaciente[] = $paciente;
            }
            $nomePaciente = $this->arquivo->removerAcentos($paciente->nomePaciente);
            $dadosProfissaoSemAcentos = $this->arquivo->removerAcentos($dadosPaciente);

            if (stristr($nomePaciente, $dadosProfissaoSemAcentos) !== false) {
                $arrDadosPaciente[] = $paciente;
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
