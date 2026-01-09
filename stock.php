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
