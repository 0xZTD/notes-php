<?php

namespace Zeth\NotesPhp\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zeth\NotesPhp\Interfaces\RepositoryInterface;
use Zeth\NotesPhp\Repositories\InMemoryRepository;
use Zeth\NotesPhp\Models\Note;


class NoteController
{
    private RepositoryInterface $repo;

    public function __construct(RepositoryInterface $repositoryInterface)
    {
        $this->repo = $repositoryInterface;
    }

    public function notes(Request $request, Response $response, $args)
    {
        $data = $this->repo->getAll();
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function note(Request $request, Response $response, $args)
    {
        $data = $this->repo->getById($args['id']);
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function createNote(Request $request, Response $response, $args)
    {
        $data = $request->getBody();
        $content = json_decode($data);
        if (isset($content->{'id'})) {
            $n = new Note($content->{'id'}, $content->{'text'});
        } else {
            $n = Note::createNote($content->{'text'});
        }
        $this->repo->save($n);
        $response->getBody()->write(json_encode($n));
        return $response->withHeader('Content-Type', 'application/json');
    }
}