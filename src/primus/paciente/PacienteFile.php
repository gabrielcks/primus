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
        $diretorio = '../data/pacientes/';
        $data = explode("/",$dadosPaciente);
        $data = $data[2] . '-' . $data[1] . '-' . $data[0];
        $arrDadosPaciente = [];
        $retornaDiretorio = dir($diretorio);

        while ($arquivo = $retornaDiretorio->read()) {
            if ($arquivo === "." || $arquivo === ".." || is_dir($diretorio.$arquivo)) {
                continue;
            }

            $paciente = $this->get($arquivo);
            if (stristr($paciente->data, $data) !== false) {
                $arrDadosPaciente[] = $paciente;
            } else {
                $nomePaciente = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/",
                "/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/"
                ,"/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),
                explode(" ","a A e E i I o O u U n N"),$paciente->nomePaciente);

                if (stristr($nomePaciente, $dadosPaciente) !== false) {
                    $arrDadosPaciente[] = $paciente;
                }
            }   
        }
        $retornaDiretorio->close();
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
