<?php

$db = new SQLite3('db.sqlite'); 

$query = "CREATE TABLE IF NOT EXISTS Products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    stock INTEGER NOT NULL,
    barcode TEXT NOT NULL UNIQUE
)";

$db->exec($query);


$query = "CREATE TABLE IF NOT EXISTS Services (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL
)";

$db->exec($query);