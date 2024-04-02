<?php
namespace Zeth\NotesPhp\Models;

class Note
{
    public int $id;
    public string $text;

    public function __construct(int $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    static public function createNote(string $text): Note
    {
        $id = rand();
        return new Note($id, $text);
    }
}
