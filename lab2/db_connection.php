<?php
function db_connect() : SQLite3{
    return new SQLite3(__DIR__ . "/database/task_db.sqlite");
}