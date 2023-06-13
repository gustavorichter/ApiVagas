<?php

namespace Src\Routes;

use Src\Controllers\AbstractController;
use Src\Providers\ApiKeyMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

class ApiRoutes {
	public function __construct() {
        $this->registerRoutes();
    }

	public function registerRoutes() {
		$app = new App;

		$app->group('/api', function () use ($app) {
			$app->get('/vagas', function (Request $request, Response $response, array $args) {
				$objVaga = new AbstractController();
				$user = $objVaga->vagas();
				return $response->withJson($user, 200);
			});

			$app->post('/novaVaga', function (Request $request, Response $response) {
				$data = $request->getParsedBody();
				$obj = new AbstractController();

				$retorno = $obj->salvarVaga($data);
				return $response->withJson($retorno, 200);
			});

			$app->put('/vagas/{id}', function (Request $request, Response $response, array $args) {
                $id = $args['id'];
                $data = $request->getParsedBody();
                $obj = new AbstractController();

                $retorno = $obj->editarVaga($id, $data);
                return $response->withJson($retorno, 200);
            });

            $app->get('/vagas/{id}', function (Request $request, Response $response, array $args) {
                $id = $args['id'];
                $obj = new AbstractController();

                $vaga = $obj->getVaga($id);
                if ($vaga) {
                    return $response->withJson($vaga, 200);
                } else {
                    return $response->withStatus(404)->withJson(['message' => 'Vaga não encontrada']);
                }
            });

		})->add(new ApiKeyMiddleware());

		$app->run();
	}
}

$apiRoutes = new ApiRoutes();