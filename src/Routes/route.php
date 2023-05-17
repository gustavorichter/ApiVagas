<?php

namespace Src\Routes;

use Src\Controllers\AbstractController;
use Src\Providers\ApiKeyMiddleware;

$app = new \Slim\App;
$app->group('/api', function () use ($app) {

    $app->get('/vagas', function ($request, $response, $args) {
        $ObjVaga = new AbstractController();
        $user = $ObjVaga->vagas();
        return $response->withJson($user, 200);
    });

    $app->post('/novaVaga', function ($request, $response, $args) {
        
    });
})->add(new ApiKeyMiddleware());

$app->run();