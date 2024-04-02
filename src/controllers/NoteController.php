<?php

namespace Zeth\NotesPhp\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zeth\NotesPhp\Repositories\InMemoryRepository;

class NoteController
{
    private $repo;

    public function __construct()
    {
        $this->repo = new InMemoryRepository();
    }

    public function notes(Request $request, Response $response, $args)
    {
        $data = $this->repo->getAll();
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}