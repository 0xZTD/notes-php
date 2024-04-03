<?php
namespace Zeth\NotesPhp\Repositories;

use Zeth\NotesPhp\Db\SQLiteDb;
use Zeth\NotesPhp\Interfaces\RepositoryInterface;
use Zeth\NotesPhp\Models\Note;


class SQLiteRepository implements RepositoryInterface
{
    private $db;

    public function __construct()
    {
        $this->db = new SQLiteDb("notes.db");
    }

    public function save(Note $note)
    {

    }

    public function getAll(): array
    {
        return [];
    }

    public function getById(int $id): ?Note
    {
    }

    public function delete(int $id)
    {
    }

    public function update(Note $note)
    {
    }
}
