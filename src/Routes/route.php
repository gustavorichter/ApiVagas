<?php

namespace Src\Routes;

use Src\Controllers\AbstractController;
use Src\Providers\ApiKeyMiddleware;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$app->group('/api', function () use ($app) {

    $app->get('/vagas', function ($request, $response, $args) {
        $ObjVaga = new AbstractController();
        $user = $ObjVaga->vagas();
        return $response->withJson($user, 200);
    });

    $app->post('/novaVaga', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $obj = new AbstractController();

        $retorno = $obj->salvarVaga($data);
        return $response->withJson($retorno, 200);
    });
})->add(new ApiKeyMiddleware());

$app->run();