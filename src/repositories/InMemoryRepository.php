<?php

namespace Zeth\NotesPhp\Repositories;

use Zeth\NotesPhp\Interfaces\RepositoryInterface;
use Zeth\NotesPhp\Models\Note;

class InMemoryRepository implements RepositoryInterface
{
    private array $db = [];

    public function save(Note $note)
    {
        $this->db[] = $note;
    }

    public function getAll(): array
    {
        return $this->db;
    }

    public function getById(int $id): ?Note
    {
        for ($i = 0; $i < count($this->db); $i++) {
            $n = $this->db[$i];
            if ($n->id == $id) {
                return $n;
            }
        }
        return null;
    }

    public function delete(int $id)
    {
        $idx = -1;
        for ($i = 0; $i < count($this->db); $i++) {
            $n = $this->db[$i];
            if ($n->id == $id) {
                $idx = $i;
            }
        }
        if ($idx != -1)
            unset($this->db[$idx]);
    }

    public function update(Note $note)
    {
        for ($i = 0; $i < count($this->db); $i++) {
            $n = $this->db[$i];
            if ($n->id == $note->id) {
                $n->text = $note->text;
            }
        }
    }

}
