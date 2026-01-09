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
$query = "CREATE TABLE IF NOT EXISTS Sales (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date TEXT NOT NULL,
    product_id INTEGER,
    service_id INTEGER,
    quantity INTEGER,
    total REAL,
    FOREIGN KEY (product_id) REFERENCES Products(id),
    FOREIGN KEY (service_id) REFERENCES Services(id)
)";

$db->exec($query);
$db->exec("INSERT OR IGNORE INTO Sales (date, product_id, quantity, total) VALUES
('2025-05-12 10:00:00', 1, 0, 0.00), 
('2025-05-12 11:00:00', 2, 0, 0.00),
('2025-05-12 11:00:00', 3, 0, 0.00); ");
$db->exec("INSERT OR IGNORE INTO Products (name, price, stock, barcode) VALUES ('Hair Gel', 5.00, 100, '1234567890123')");
$db->exec("INSERT OR IGNORE INTO Products (name, price, stock, barcode) VALUES ('Hair Comb', 2.00, 50, '1234567890124')");
$db->exec("INSERT OR IGNORE INTO Products (name, price, stock, barcode) VALUES ('Haircut Machine', 10.00, 30, '1234567890125')");
$db->exec("INSERT OR IGNORE INTO Services (name, price) VALUES ('Qethje', 3.00)");
$db->exec("INSERT OR IGNORE INTO Services (name, price) VALUES ('Qethje me rroje', 4.00)");
$db->exec("INSERT OR IGNORE INTO Services (name, price) VALUES ('Larje Flokve', 1.00)");
$db->exec("INSERT OR IGNORE INTO Services (name, price) VALUES ('Pastrimi Ftyres me Dyll', 2.00)");

echo "Database initialized successfully.";
?>
