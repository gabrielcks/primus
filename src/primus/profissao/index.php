<?php 
require_once '../config/autoLoad.php';

use Profissao\ProfissaoController;

$profissaoController = new ProfissaoController;
$acao = $_REQUEST['acao'];
$acao = (empty($acao) || !method_exists($profissaoController,$acao)) ? 'listar': $acao;
$profissaoController->$acao();
$profissao = $profissaoController->viewData->listaDeProfissao;
include '../teste.php';
include 'index.phtml';