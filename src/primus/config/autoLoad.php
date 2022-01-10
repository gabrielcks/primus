<?php
namespace Primus\Config;

function autoLoading($class) { 

    $caminhos = [
        'Paciente' => __DIR__ . '/../paciente/',
        'Primus' => __DIR__ . '/../lib/core/',
        'Primus\File' => __DIR__ . '/../lib/file/',
        'Primus\Lib\Bd' => __DIR__ . '/../lib/bd/',
        'Primus\Config' => __DIR__ ."/",
        'Profissao' =>  __DIR__ . '/../profissao/',
    ];

    
    $arrCaminhos = explode("\\", $class);
    $ultimaChave = end($arrCaminhos);
    array_pop($arrCaminhos);
    $arrCaminhos = implode("\\", $arrCaminhos);    
    if (isset($caminhos[$arrCaminhos])) {

        $paciente = $caminhos[$arrCaminhos] . $ultimaChave . '.php';
        if (file_exists($paciente)) {
            require_once $paciente;
        }
    }
};
spl_autoload_register('Primus\Config\autoLoading');