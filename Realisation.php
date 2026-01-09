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
