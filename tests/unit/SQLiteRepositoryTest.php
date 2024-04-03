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
    private RepositoryInterface $repo;

    protected function setUp(): void
    {
        $this->repo = new SQLiteRepository(':memory:');
    }

    public function testSaveFunctionAddsNoteToDb(): void
    {
        $n = Note::createNote("Test note");
        $this->repo->save($n);

        $got = $this->repo->getById($n->id);
        $this->assertEquals($n, $got);
    }

    public function testGetAllReturnArrayWithNotes(): void
    {
        $want = [
            Note::createNote("1"),
            Note::createNote("2"),
            Note::createNote("3"),
            Note::createNote("4"),
            Note::createNote("5"),
            Note::createNote("6"),
        ];
        for ($i = 0; $i < count($want); $i++) {
            $this->repo->save($want[$i]);
        }
        $got = $this->repo->getAll();

        $this->assertEqualsCanonicalizing($want, $got);

    }

    public function testGetByIdReturnsSpecifiedNote(): void
    {
        $n = Note::createNote("Test note");
        $n2 = new Note(1337, "Test note");

        $this->repo->save($n);
        $this->repo->save($n2);


        $got = $this->repo->getById($n2->id);
        $this->assertEquals($n2, $got);

    }

    public function testDeleteRemovesNote(): void
    {
        $n = Note::createNote("Test note");
        $this->repo->save($n);
        $this->repo->delete($n->id);

        $got = $this->repo->getById($n->id);
        $this->assertNull($got);
    }

    public function testUpdateUpdatesNote(): void
    {
        $n = Note::createNote("Test note");
        $want = new Note(1337, "Test notex");

        $this->repo->save($n);
        $this->repo->update($n->id, $want);


        $got = $this->repo->getById(1337);
        $this->assertEquals($want, $got);
    }

}
