<?php
namespace Profissao;
use Primus\IPersistencia;
use \Primus\Lib\Bd\Conexao;

class ProfissaoTable implements IPersistencia
{
    public $conexao;
    public $objPdo;

    public function __construct()
    {
        $this->conexao = new Conexao;
        $this->objPdo = $this->conexao->conect();

        if (is_a($this->objPdo, 'PDO') !== true) {
            print_r("ERRO!! conexão com o banco de dados, OBJ PDO com valor não esperado !! ");
            die;
        }
    }

    public function delet($id):bool
    {
        $this->objPdo->query("DELETE FROM profissao WHERE id = '{$id}'");
        return true; 
    }

    public function save(array $dados):bool
    {
        if (empty($dados['id'])) {
            $id =  uniqid();
            $profissao = trim($dados['nome']);
            if (empty($profissao)) {
                return false;
            }

            $status = $dados['status'];

            return $this->objPdo->exec("INSERT  INTO profissao(id, nome, `status`)
            values ('{$id}', '{$profissao}', '{$status}')");

        } elseif (!empty($dados['id'])) {
            return $this->objPdo->exec("UPDATE profissao 
            SET id = '{$dados['id']}',
            nome = '{$dados['nome']}', 
            `status` = '{$dados['status']}'

            WHERE id = '{$dados['id']}' ");
        }
    }

    public function get($id):object
    {
        $result = $this->objPdo->query("SELECT * FROM profissao WHERE id = '{$id}' ");
        return $result->fetchObject();
    }

    public function getAll():array
    {
        $result = $this->objPdo->query('SELECT * FROM profissao');
        if ($result !== false) {
            $retorno = $result->fetchAll(\PDO::FETCH_OBJ);
        }

        return $retorno;
    }
    public function find($dado):array
    {
        $result = $this->objPdo->query("SELECT * FROM profissao WHERE nome LIKE '%{$dado['dadosProfissao']}%' ");
            if ($result !== false) {
                $retorno = $result->fetchAll(\PDO::FETCH_OBJ);
                
            }
        return $retorno;
    }
}
