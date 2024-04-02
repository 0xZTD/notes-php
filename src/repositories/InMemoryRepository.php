<?php

namespace Zeth\NotesPhp\Repositories;

use Zeth\NotesPhp\Interfaces\RepositoryInterface;
use Zeth\NotesPhp\Models\Note;

class InMemoryRepository implements RepositoryInterface
{
    static private array $db = [];

    public function save(Note $note)
    {
        self::$db[] = $note;
    }

    public function getAll(): array
    {
        return self::$db;
    }

    public function getById(int $id): Note
    {
        for ($i = 0; $i < count(self::$db); $i++) {
            $n = self::$db[$i];
            if ($n->id == $id) {
                return $n;
            }
        }
        return new Note;
    }

    public function delete(int $id)
    {
        $idx = -1;
        for ($i = 0; $i < count(self::$db); $i++) {
            $n = self::$db[$i];
            if ($n->id == $id) {
                $idx = $i;
            }
        }
        if ($idx != -1)
            unset(self::$db[$idx]);
    }

    public function update(Note $note)
    {
        for ($i = 0; $i < count(self::$db); $i++) {
            $n = self::$db[$i];
            if ($n->id == $note->id) {
                $n = $note;
            }
        }
    }

}
