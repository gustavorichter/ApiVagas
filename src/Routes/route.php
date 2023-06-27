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

            $app->get('/vaga/{id}', function (Request $request, Response $response, array $args) {
                $id = $args['id'];
                $obj = new AbstractController();

                $vaga = $obj->getVaga($id);
                if ($vaga) {
                    return $response->withJson($vaga, 200);
                } else {
                    return $response->withStatus(404)->withJson(['message' => 'Vaga não encontrada']);
                }
            });

			$app->delete('/vaga/{id}', function (Request $request, Response $response, array $args) {
                $id = $args['id'];
                $obj = new AbstractController();

                $retorno = $obj->excluirVaga($id);
                if ($retorno) {
                    return $response->withJson(['message' => 'Vaga excluída com sucesso'], 200);
                } else {
                    return $response->withStatus(404)->withJson(['message' => 'Vaga não encontrada']);
                }
            });

            // $app->options('/{routes:.+}', function ($request, $response, $args) {
            //     return $response;
            // });

            // $app->add(function ($req, $res, $next) {
            //     $response = $next($req, $res);
            //     return $response
            //             ->withHeader('Access-Control-Allow-Origin', '*')
            //             ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            //             ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
            // });

            // // Catch-all route to serve a 404 Not Found page if none of the routes match
            // // NOTE: make sure this route is defined last
            // $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
            //     $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
            //     return $handler($req, $res);
            // });

		})->add(new ApiKeyMiddleware());

        $corsMiddleware = function (Request $request, Response $response, $next) {
            // Adiciona os cabeçalhos CORS
            $response = $response
                ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Api-Key');

            // Verifica se é uma requisição OPTIONS e retorna a resposta imediatamente
            if ($request->getMethod() === 'OPTIONS') {
                return $response;
            }

            // Chama o próximo middleware
            $response = $next($request, $response);

            return $response;
        };

        $app->add($corsMiddleware);
        $app->run();
	}
}