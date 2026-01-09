<?php    
header('Content-Type: application/json');    
try {    
    $db = new SQLite3('db.sqlite');    
    $data = json_decode(file_get_contents('php://input'), true);    
    $barcode = $data['barcode'];    
  
    
    error_log("Received barcode: " . $barcode);  
  
    $query = $db->prepare("SELECT * FROM Products WHERE barcode = :barcode");    
    $query->bindValue(':barcode', $barcode);    
    $result = $query->execute();    
  
    
    if (!$result) {  
        error_log("Query execution failed: " . $db->lastErrorMsg());  
        echo json_encode(["error" => "Query execution failed"]);  
        exit;  
    }  
  
    $product = $result->fetchArray(SQLITE3_ASSOC);    
  
    if ($product) {    
        echo json_encode($product);    
    } else {    
        echo json_encode(["error" => "Product not found"]);    
    }    
    $db->close();    
} catch (Exception $e) {    
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);    
}    
?>  