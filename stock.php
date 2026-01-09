<?php
try {
   
    $db_path = __DIR__ . '/backend/db.sqlite';
    $db = new SQLite3($db_path);

    if (!$db) {
        throw new Exception("Failed to connect to database");
    }

    $available_query = "SELECT id, name, stock FROM Products";
    $available_result = $db->query($available_query);

    $sold_query = "SELECT p.id, p.name, SUM(s.quantity) as total_sold
                   FROM Sales s
                   JOIN Products p ON s.product_id = p.id
                   GROUP BY p.id, p.name";
    $sold_result = $db->query($sold_query);

    $sold_data = [];
    while ($row = $sold_result->fetchArray(SQLITE3_ASSOC)) {
        $sold_data[$row['id']] = $row['total_sold'];
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
    </style>
</head>
<body>
    <a href="index.php" class="back-btn">Kthehu Mbrapa</a>
    <h1>Informacionet e Invertarit</h1>
    <table>
        <tr>
            <th>Emri Produktit</th>
            <th>Invertari Aktiv</th>
            <th>Shitjet Totale</th>
        </tr>
