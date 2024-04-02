<?php

namespace Zeth\NotesPhp\Interfaces;

use Zeth\NotesPhp\Models\Note;

interface RepositoryInterface
{
    public function save(Note $note);
    public function getAll(): array;
    public function getById(int $id): ?Note;
    public function delete(int $id);
    public function update(Note $note);
}