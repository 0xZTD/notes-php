<?php
require __DIR__ . '/../vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;
use Zeth\NotesPhp\Controllers\NoteController;
use Zeth\NotesPhp\Repositories\SQLiteRepository;
use Psr\Container\ContainerInterface;


$container = new Container();
$container->set('repo', function () {
    return new SQLiteRepository();
});

$container->set(NoteController::class, function (ContainerInterface $container) {
    $repo = $container->get('repo');

    return new NoteController($repo);
});

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/note', NoteController::class . ":notes");
$app->get('/note/[{id}]', NoteController::class . ":note");
$app->post('/note', NoteController::class . ":createNote");



$app->run();
