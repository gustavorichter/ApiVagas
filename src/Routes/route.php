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

        $corsMiddleware = function (Request $request, Response $response, $next) {
            // Adiciona os cabeçalhos CORS
            $response = $response
                ->withHeader('X-Type', 'api')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
                ->withHeader('Access-Control-Allow-Headers', 'X-Api-Key, Origin, X-Requested-With, Content-Type, Accept, Authorization, X-Type');

            if ($request->getMethod() === 'OPTIONS') {
                return $response;
            }

            // Chama o próximo middleware
            $response = $next($request, $response);

            return $response;
        };

        $app->add($corsMiddleware);

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
        })->add(new ApiKeyMiddleware());

       
        $app->run();
    }
}
