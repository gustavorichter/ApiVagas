<?php

namespace Src\Controllers;

use Src\Entity\Vaga;
use Src\Db\Database;

class AbstractController {

	public function vagas() {
		$ObjVaga = new Vaga();
		$vagas = $ObjVaga->getVagas();

		return $vagas;
	}

	public function salvarVaga($data) {
		$titulo = $data['titulo'];
        $descricao = $data['descricao'];
        $ativo = $data['ativo'];

		$obVaga = new Vaga;
		$obVaga->titulo = $titulo;
		$obVaga->descricao =  $descricao;
		$obVaga->ativo =  $ativo;
		$obVaga->cadastrar();

		$result = [
			'titulo' => $titulo,
			'descricao' => $descricao,
			'ativo' => $ativo
		];
		return $result;
	}
}