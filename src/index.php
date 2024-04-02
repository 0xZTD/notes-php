<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Zeth\NotesPhp\Controllers\NoteController;
use Zeth\NotesPhp\Models\Note;

$app = AppFactory::create();

$app->get('/note', NoteController::class . ":notes");
$app->get('/note/[{id}]', NoteController::class . ":notes");


$app->run();
