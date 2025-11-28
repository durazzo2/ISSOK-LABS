<?php

require_once __DIR__ . '/../db_connection.php';

$db = connectDatabase();

$query = "
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
)";

$db->exec($query);
