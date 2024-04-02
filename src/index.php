<?php
require __DIR__ . '/../vendor/autoload.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Zeth\NotesPhp\Models\Note;
use Zeth\NotesPhp\Repositories\InMemoryRepository;

$app = AppFactory::create();
$repo = new InMemoryRepository();
$repo->save(Note::createNote("Test"));

$app->get('/note', function (Request $request, Response $response, $args) use ($repo) {
    $data = $repo->getAll();
    $payload = json_encode($data);

    $response->getBody()->write($payload);
    return $response
        ->withHeader('Content-Type', 'application/json');
});

$app->run();
