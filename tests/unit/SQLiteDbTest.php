<?php
namespace Zeth\NotesPhp\Tests;

use PHPUnit\Framework\TestCase;
use Zeth\NotesPhp\Db\SQLiteDb;

class SQLiteDbTest extends TestCase
{
    public function testDbCanBeCreatedFromString()
    {
        $db = new SQLiteDb('');
        $db->exec("INSERT INTO notes (text) VALUES ('This is a test')");
        $result = $db->query('SELECT * FROM notes')->fetchArray();
        $this->assertEquals('This is a test', $result['text']);
    }
}