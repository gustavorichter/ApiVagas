<?php

use \App\Session\Login;

//Dados do ususrio logado
$usuarioLogado = Login::getUsaurioLogado();

//Detalhes dos usuarios
$usuario = $usuarioLogado ? $usuarioLogado['nome'].' <a href="logout.php" class="text-light font-weight-bold ml-2">Sair</a>' : 'Visitante <a href="login.php" class="text-light font-weight-bold ml-2">Entrar</a>';

?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

	<title>Cadastro Vagas</title>
</head>
<body class="bg-dark text-light">
	<div class="container">
		<div class="jumbotron bg-danger">
			<h1>Cadastro de Vagas</h1>
			<p>Exemplo de CRUD com PHP orientado a objetos.</p>

			<hr class="border-light">
			<div class="d-flex justify-content-start">
				<p>Logado como: <?=$usuario?></p>
			</div>

		</div>