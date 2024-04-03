<?php
namespace Zeth\NotesPhp\Tests;

use PHPUnit\Framework\TestCase;
use Zeth\NotesPhp\Models\Note;
use Zeth\NotesPhp\Repositories\InMemoryRepository;


final class InMemoryRepositoryTest extends TestCase
{

    public function testSaveFunctionAddsNoteToDb(): void
    {
        $repo = new InMemoryRepository();
        $want = Note::createNote("test");

        $repo->save($want);
        $got = $repo->getAll()[0];
        $this->assertEquals($got, $want);
    }

    public function testGetAllReturnArrayWithNotes(): void
    {
        $repo = new InMemoryRepository();

        $want = [
            Note::createNote("1"),
            Note::createNote("2"),
            Note::createNote("3"),
            Note::createNote("4"),
            Note::createNote("5"),
            Note::createNote("6"),
        ];
        for ($i = 0; $i < count($want); $i++) {
            $repo->save($want[$i]);
        }
        $got = $repo->getAll();

        $this->assertEquals($want, $got);
    }

    public function testGetByIdReturnsSpecifiedNote(): void
    {
        $repo = new InMemoryRepository();
        $want = new Note(1488, "text");

        $repo->save($want);
        $got = $repo->getById(1488);
        $this->assertEquals($got, $want);
    }

    public function testUpdateUpdatesNote(): void
    {
        $repo = new InMemoryRepository();
        $want = new Note(1488, "text");
        $repo->save($want);

        $want->text = "text2";
        $repo->update($want);

        $got = $repo->getById(1488);
        $this->assertEquals($got, $want);
    }

    public function testDeleteRemovesNote(): void
    {
        $repo = new InMemoryRepository();
        $want = new Note(1488, "text");
        $repo->save($want);
        $repo->delete($want->id);
        $got = $repo->getById($want->id);
        $this->assertEquals($got, null);
    }

}
