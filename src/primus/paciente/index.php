<?php
require_once '../config/autoLoad.php';
use \Paciente\PacienteController;

$pacienteController = new PacienteController;
$acao = $_REQUEST['acao'];
$acao = (empty($acao) || !method_exists($pacienteController,$acao)) ? 'listar': $acao;
$pacienteController->$acao();
$paciente = $pacienteController->viewData->paciente;
$profissao = $pacienteController->viewData->profissao;
include '../nav.php';
include 'index.phtml';