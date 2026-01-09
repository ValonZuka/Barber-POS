<?php
header('Content-Type: application/json');
try {
    $db = new SQLite3(__DIR__ . '/db.sqlite');
    $data = json_decode(file_get_contents('php://input'), true);
    $total = 0;
    $date = date('Y-m-d H:i:s');

    
    $db->exec('BEGIN TRANSACTION');

    foreach ($data as $item) {
        $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
        $item_total = $item['price'] * $quantity;
        $total += $item_total;

        
        error_log("Processing item: " . json_encode($item));

        
        $service_query = $db->prepare("SELECT id FROM Services WHERE name = :name");
        $service_query->bindValue(':name', $item['product_id']);
        $service_result = $service_query->execute();
        $service = $service_result->fetchArray(SQLITE3_ASSOC);

        if ($service) {
            
            $query = $db->prepare("INSERT INTO Sales (date, service_id, quantity, total) VALUES (:date, :service_id, :quantity, :total)");
            $query->bindValue(':date', $date);
            $query->bindValue(':service_id', $service['id']);
            $query->bindValue(':quantity', $quantity);
            $query->bindValue(':total', $item_total);
            if (!$query->execute()) {
                throw new Exception("Failed to insert service sale: " . $db->lastErrorMsg());
            }
        } else {
            
            $product_query = $db->prepare("SELECT id, stock FROM Products WHERE id = :id");
            $product_query->bindValue(':id', (int)$item['product_id']);
            $product_result = $product_query->execute();
            $product = $product_result->fetchArray(SQLITE3_ASSOC);

            if ($product) {
                
                if ($product['stock'] < $quantity) {
                    throw new Exception("Insufficient stock for {$item['name']}. Available: {$product['stock']}, Requested: {$quantity}");
                }

               
                $query = $db->prepare("INSERT INTO Sales (date, product_id, quantity, total) VALUES (:date, :product_id, :quantity, :total)");
                $query->bindValue(':date', $date);
                $query->bindValue(':product_id', $product['id']);
                $query->bindValue(':quantity', $quantity);
                $query->bindValue(':total', $item_total);
                if (!$query->execute()) {
                    throw new Exception("Failed to insert product sale: " . $db->lastErrorMsg());
                }

               
                $update_query = $db->prepare("UPDATE Products SET stock = stock - :quantity WHERE id = :product_id");
                $update_query->bindValue(':quantity', $quantity);
                $update_query->bindValue(':product_id', $product['id']);
                if (!$update_query->execute()) {
                    throw new Exception("Failed to update stock: " . $db->lastErrorMsg());
                }
            } else {
                throw new Exception("Product not found for product_id: {$item['product_id']}");
            }
        }
    }
       $db->exec('COMMIT');
    echo json_encode(['total' => $total]);
    $db->close();
} catch (Exception $e) {
   
    $db->exec('ROLLBACK');
    error_log("API error: " . $e->getMessage());
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    $db->close();
}
?>