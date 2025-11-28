<?php

require_once __DIR__ . '/../db_connection.php';

$db = connectDatabase();

$query = "
CREATE TABLE IF NOT EXISTS events (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    location TEXT NOT NULL,
    event_date TEXT NOT NULL,
    event_type TEXT NOT NULL CHECK (event_type IN ('јавен','приватен'))
)";

$db->exec($query);
