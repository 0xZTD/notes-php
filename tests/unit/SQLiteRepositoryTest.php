<?php
namespace Zeth\NotesPhp\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use Zeth\NotesPhp\Interfaces\RepositoryInterface;
use Zeth\NotesPhp\Models\Note;
use Zeth\NotesPhp\Repositories\SQLiteRepository;

#[RequiresPhpExtension('sqlite3')]
final class SQLiteRepositoryTest extends TestCase
{
    private RepositoryInterface $db;

    protected function setUp(): void
    {
        $this->db = new SQLiteRepository(':memory:');
    }

    public function testSaveFunctionAddsNoteToDb(): void
    {
        $n = Note::createNote("Test note");
        $this->db->save($n);

        $got = $this->db->getById($n->id);
        $this->assertEquals($n, $got);
    }

    public function testGetAllReturnArrayWithNotes(): void
    {

    }

    public function testGetByIdReturnsSpecifiedNote(): void
    {

    }

    public function testUpdateUpdatesNote(): void
    {

    }

    public function testDeleteRemovesNote(): void
    {

    }
}
