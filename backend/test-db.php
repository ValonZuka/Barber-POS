<?php
header('Content-Type: application/json');
try {
    $db = new SQLite3('db.sqlite');
    $result = $db->query("SELECT * FROM Products WHERE barcode = '1234567890123'");
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Product not found"]);
    }
    $db->close();
} catch (Exception $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>