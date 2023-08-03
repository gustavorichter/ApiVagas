<?php
require_once __DIR__ . '/../src/vendor/autoload.php';
use Vagas\Routes\ApiRoutes;

$headers = getallheaders();
$xType = isset($headers['X-Type']) ? $headers['X-Type'] : '';

if ($xType === 'api') {
    $apiRoutes = new ApiRoutes();
} else {
    $variavel = 12121212;
    var_dump($variavel);
}