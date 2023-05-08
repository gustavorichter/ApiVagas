<?php

namespace src\Controllers;
use src\Entity\Vaga;
use src\Db\Database;

class AbstractController {

	public function usuarios() {
		$payload=[];
        array_push($payload, array("name"=>"Bob"  ,"birth-year"=>1993));
        array_push($payload, array("name"=>"Alice","birth-year"=>1995));

		$teste = new Vaga();
		$vagas = $teste->getVagas();

		return $vagas;
	}
}