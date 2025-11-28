<?php
function db_connect(): SQLite3 {
    $dbPath = __DIR__ . "/database/tasks_db.sqlite";
    $db = new SQLite3($dbPath);

    $db->exec("
        CREATE TABLE IF NOT EXISTS tasks (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            due_date TEXT NOT NULL,
            priority TEXT NOT NULL,
            status TEXT NOT NULL
        )
    ");
    return $db;
}
?>
