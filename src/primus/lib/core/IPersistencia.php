<?php

namespace Primus;

interface IPersistencia
{
    public function delet($id):bool;
    public function save(array $dados):bool;
    public function get($id):object;
    public function getAll():array;
    public function find($dadosPaciente):array;
}