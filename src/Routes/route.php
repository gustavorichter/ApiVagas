<?php

namespace Src\Routes;

use Src\Controllers\AbstractController;

$app = new \Slim\App;
$app->get('/getUsers', function ($request, $response, $args) {
    $teste = new AbstractController();
    $user = $teste->usuarios();
    return $response->withJson($user, 200);
});

$app->run();