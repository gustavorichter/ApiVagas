<?php

namespace Src\Controllers;

use Src\Entity\Vaga;
use Src\Db\Database;

class AbstractController {

	public function usuarios() {
		$teste = new Vaga();
		$vagas = $teste->getVagas();

		return $vagas;
	}
}