<?php
require __DIR__ . '/../vendor/autoload.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/data', function (Request $request, Response $response, $args) {
    $data = array ('name' => 'Bob', 'age' => 40);
    $payload = json_encode($data);

    $response->getBody()->write($payload);
    return $response
        ->withHeader('Content-Type', 'application/json');


});

$app->run();
