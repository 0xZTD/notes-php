<?php
namespace Zeth\NotesPhp\Repositories;

use Zeth\NotesPhp\Db\SQLiteDb;
use Zeth\NotesPhp\Interfaces\RepositoryInterface;
use Zeth\NotesPhp\Models\Note;


class SQLiteRepository implements RepositoryInterface
{
    private $db;

    public function __construct(string $conn = 'notes.db')
    {
        $this->db = new SQLiteDb($conn);
    }

    public function save(Note $note)
    {
        $stmt = $this->db->prepare('INSERT INTO notes(id,text) VALUES(:id,:text)');
        $stmt->bindValue(":id", $note->id, SQLITE3_INTEGER);
        $stmt->bindValue(":text", $note->text, SQLITE3_TEXT);
        $stmt->execute();
    }

    public function getAll(): array
    {
        $notes = [];
        $res = $this->db->query('SELECT * FROM notes');
        while ($r = $res->fetchArray()) {
            $n = new Note($r['id'], $r['text']);
            array_push($notes, $n);
        }
        return $notes;
    }

    public function getById(int $id): ?Note
    {
        $stmt = $this->db->prepare('SELECT * FROM notes WHERE id=:id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        $result = $stmt->execute();
        $res = $result->fetchArray();
        if (isset($res['id']))
            return new Note($res['id'], $res['text']);
        return null;
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare('DELETE FROM notes WHERE id=:id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        $stmt->execute();
    }

    public function update(Note $note)
    {
    }
}
