<?php

require_once __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;
use \App\Db\Pagination;
use \App\Session\Login;

//Obriga o ususario a estar logado
Login::requireLogin();

//Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_UNSAFE_RAW);

//Filtro status
$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_UNSAFE_RAW);
$filtroStatus = in_array($filtroStatus, ['s','n']) ? $filtroStatus : '';

//Condições SQL
$condicoes = [
    strlen($busca) ? 'titulo LIKE "%' . str_replace(' ', '%', $busca) . '%"' : null,
    strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
];

//Remove posições vazias.
$condicoes = array_filter($condicoes);

//Clausula where
$where = implode(' AND ', $condicoes);

//Quantidade total de vagas
$quantidadeDeVagas = Vaga::getQuantidadeVagas($where);

//Páginação
$obPagination = new Pagination($quantidadeDeVagas ,$_GET['pagina'] ?? 1, 5);

//Obtem as vagas
$vagas = Vaga::getVagas($where, null, $obPagination->getLimit());

include_once __DIR__ . '/includes/header.php';
include_once __DIR__ . '/includes/listagem.php';
include_once __DIR__ . '/includes/footer.php';
