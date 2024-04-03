<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Zeth\NotesPhp\Controllers\NoteController;

$app = AppFactory::create();

$app->get('/note', NoteController::class . ":notes");
$app->get('/note/[{id}]', NoteController::class . ":note");
$app->post('/note', NoteController::class . ":createNote");



$app->run();
