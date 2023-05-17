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
}