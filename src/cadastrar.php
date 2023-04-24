<?php

require_once __DIR__ . '/vendor/autoload.php';

define('TITLE', 'Cadastrar Vaga');

use \App\Entity\Vaga;
use \App\Session\Login;

//Obriga o ususario a estar logado
Login::requireLogin();

//Instancia de vaga
$obVaga = new Vaga;

if (isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])) {
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo = $_POST['ativo'];
    $obVaga->cadastrar();

    //Exibe o sucesso na url
    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/includes/header.php';
include_once __DIR__ . '/includes/formulario.php';
include_once __DIR__ . '/includes/footer.php';