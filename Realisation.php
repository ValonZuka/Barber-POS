<?php
try {
    $db_path = __DIR__ . '/backend/db.sqlite';
    $db = new SQLite3($db_path);

    if (!$db) {
        throw new Exception("Failed to connect to database");
    }
    $today = date('Y-m-d');
    $query = "SELECT DATE(s.date) as sale_date, p.id, p.name, SUM(s.quantity) as total_quantity, SUM(s.total) as total_price
              FROM Sales s
              JOIN Products p ON s.product_id = p.id
              WHERE s.product_id IS NOT NULL
              GROUP BY DATE(s.date), p.id, p.name
              ORDER BY sale_date DESC";
    $result = $db->query($query);

    $sales_by_date = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $date = $row['sale_date'];
        if (!isset($sales_by_date[$date])) {
            $sales_by_date[$date] = [];
        }
        $sales_by_date[$date][] = [
            'name' => $row['name'],
            'quantity' => $row['total_quantity'],
            'total_price' => $row['total_price']
        ];
    }
} catch (Exception $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuzzCut Barber</title>
    <style>
        body {
            background-color: #2c2c2c;
            color: #d4af37;
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #d4af37;
            color: #2c2c2c;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #b5942a;
        }
        .sales-section {
            margin-bottom: 30px;
        }
        .sales-section h2 {
            background-color: #4e4e4e;
            padding: 10px;
            border-radius: 5px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            background-color: #3e3e3e;
        }
        th, td {
            border: 1px solid #d4af37;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4e4e4e;
        }
        .total {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-btn">Kthehu Mbrapa</a>
    <h1>Realizimi Shitjeve</h1>
