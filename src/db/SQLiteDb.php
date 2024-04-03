<?php

namespace Zeth\NotesPhp\Db;


final class SQLiteDb extends \SQLite3
{
    const DB = 'CREATE TABLE IF NOT EXISTS notes(
        id      INTEGER NOT NULL PRIMARY KEY,
        text    TEXT
    )';

    public function __construct(string $conn)
    {
        $this->open($conn);
        $this->exec(self::DB);
    }
}
