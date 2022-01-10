<?php

namespace Paciente;
use \Primus\IPersistencia;
use \Primus\Lib\Bd\Conexao;
use stdClass;

class PacienteTable implements IPersistencia
{
    public $objPdo;
    public $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao;
        $this->objPdo = $this->conexao->conect();

        if (is_a($this->objPdo, 'PDO') !== true) {
            print_r("ERRO!! conexão com o banco de dados, OBJ PDO com valor não esperado !! ");
            die;
        }
    }

    public function delet($idNomeArquivo):bool
    {
        $this->objPdo->query("DELETE FROM paciente WHERE id = '{$idNomeArquivo}'");
        return true;  
    }

    public function save(array $dados):bool
    {
        var_dump($dados['profissao']);
        if (empty($dados['id'])) {

            $id =  uniqid();
            $nomeP = $dados['nomePaciente'];
            $emailP = $dados['email'];
            $cpfP = $dados['cpf'];
            $estadoCivilP = $dados['estadoCivil'];
            $dataP = $dados['data'];
            $sexoP = $dados['sexo'];
            $profissao = $dados['profissao'];

            return $this->objPdo->exec("INSERT  INTO paciente(id, nomePaciente, email, cpf, estadoCivil, `data` ,sexo, id_profissao_fk)
            values ('{$id}', '{$nomeP}', '{$emailP}', {$cpfP}, '{$estadoCivilP}', '{$dataP}', '{$sexoP}', '{$profissao}')");

        } elseif (!empty($dados['id'])) {

            return $this->objPdo->exec("UPDATE paciente 
            SET  
            id = '{$dados['id']}',
            nomePaciente = '{$dados['nomePaciente']}',
            email = '{$dados['email']}',
            cpf = '{$dados['cpf']}',
            estadoCivil = '{$dados['estadoCivil']}',
            `data` = '{$dados['data']}',
            sexo = '{$dados['sexo']}',
            id_profissao_fk = '{$dados['profissao']}'

            WHERE 
            id ='{$dados['id']}';");
        }
    }

    public function get($idNomeArquivo):object
    {   
        $result = $this->objPdo->query("SELECT * FROM paciente WHERE id = '{$idNomeArquivo}'");
        return $result->fetchObject();
    }

    public function getAll():array
    {   
        $result = $this->objPdo->query('SELECT * FROM paciente');
        if ($result !== false) {
            $retorno = $result->fetchAll(\PDO::FETCH_OBJ);
        }

        return $retorno;
    }

    public function find($dadosPaciente):array
    {
        $data = explode("/",$dadosPaciente);
        $datas = $data[2]  . $data[1] . $data[0];
   
        if (is_numeric($datas) !== false) {
            
            $data = $data[2] . '-' . $data[1] . '-' . $data[0];
            $result = $this->objPdo->query("SELECT * FROM paciente WHERE `data` = '{$data}'");

            if ($result !== false) {
                $retorno = $result->fetchAll(\PDO::FETCH_OBJ);

            }
        } else {
            $result = $this->objPdo->query("SELECT * FROM paciente WHERE nomePaciente LIKE '%{$dadosPaciente}%'");

            if ($result !== false) {
                $retorno = $result->fetchAll(\PDO::FETCH_OBJ);
                
            }
        }
        return $retorno;
    }
}
