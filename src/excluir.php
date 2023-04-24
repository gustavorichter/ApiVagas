<?php

require_once __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;
use \App\Session\Login;

//Obriga o ususario a estar logado
Login::requireLogin();

//Validação ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

$obVaga = Vaga::getVaga($_GET['id']);
// echo "<pre>";
// print_r($obVaga);
// echo "</pre>";

//Validar a vaga
if(!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
    exit;
}

if (isset($_POST['excluir'])) {

    $obVaga->excluir();

    //Exibe o sucesso na url
    header('location: index.php?status=success');
    exit;
}

include_once __DIR__ . '/includes/header.php';
include_once __DIR__ . '/includes/confirmar-exclusao.php';
include_once __DIR__ . '/includes/footer.php';