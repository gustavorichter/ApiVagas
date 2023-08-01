<?php

namespace Vagas\Controllers;

use Vagas\Entity\Vaga;
use Vagas\Db\Database;

class AbstractController {

	public function vagas() {
		$ObjVaga = new Vaga();
		$vagas = $ObjVaga->getVagas();

		return $vagas;
	}

	public function GetVaga($id) {
		$ObjVaga = new Vaga();
		$vagas = $ObjVaga->getVaga($id);

		return $vagas;
	}

	public function excluirVaga($id) {
		$ObjVaga = new Vaga();
		$vagas = $ObjVaga->excluir($id);

		return $vagas;
	}

	public function editarVaga($id, $data) {
		$ObjVaga = new Vaga();
		$vagas = $ObjVaga->atualizar($id, $data);

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