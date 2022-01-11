<?php
namespace Profissao;
use Primus\IPersistencia;
use \Primus\Lib\Bd\Conexao;
use \Primus\Lib\Bd\TableGateWay;

class ProfissaoTable extends TableGateWay implements IPersistencia
{

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
