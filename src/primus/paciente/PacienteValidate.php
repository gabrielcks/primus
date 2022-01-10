<?php

namespace Paciente;
use Exception;

class PacienteValidate
{
    private $paciente;

    public function __construct(Paciente $paciente)
    {
        $this->paciente = $paciente;    
    }

    public function validarEstadoCivil()
    {
        $arrEstadoCivil = ["solteiro","casado","divorciado","viuvo","separado"];
        return in_array($this->paciente->estadoCivil,$arrEstadoCivil);
    }

    public function validarCpf()
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $this->paciente->cpf);
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false; 
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    
    }

    public function ValidarData()
    {
        $hoje = date('Y-m-d');
        $data = explode("-",$this->paciente->dataNascimento);
        $d = $data[2];
        $m = $data[1];
        $y = $data[0];
        
        if ($this->paciente->dataNascimento > $hoje || $this->paciente->dataNascimento <1) {
            return false;
        } else {
            $res = checkdate($d,$m,$y);
            if ($res === false) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function validarNome()
    {   
        if (strlen($this->paciente->nomePaciente) < 4 || strlen($this->paciente->nomePaciente) > 100) {
            return false;
        } else {
            return true;
        }
    }

    public function validarEmail()
    {
        if (filter_var($this->paciente->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function validarSexo()
    {       
        if (empty($this->paciente->sexo)) {
            return false;
        } else {
            return true;
        } 
    }

    public function validarProfissao()
    {       
        if (empty($this->paciente->profissao)) {
            return false;
        } else {
            return true;
        } 
    }

    public function rodarValidacao()
    {
            
        if ($this->validarNome() === false) {
            throw new Exception("nome Invalido Possuei menos que 4 caracteres ou mais de 100");
        }

        if ($this->validarEmail() === false) {
            throw new Exception("não é um e-mail válido.");
        }

        if ($this->validarSexo() === false) {
            throw new Exception("Sexo não informado");
        }

        if ($this->ValidarData() === false) {
            throw new Exception("Data invalida");
        }             
        
        if ($this->validarCpf() === false) {
            throw new Exception("Cpf Invalido");
        }
        
        if ($this->validarEstadoCivil() === false) {
            throw new Exception("Estado civil invalido");
        }

        if ($this->validarProfissao() === false) {
            throw new Exception("Profissão invalida");
        }
    }
}

