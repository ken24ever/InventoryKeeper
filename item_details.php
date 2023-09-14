
<?php
// Include the database connection
include('connection.php');

// Get the search term from the AJAX request
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

// Check if the search term is numeric or alphabetical
if (is_numeric($searchTerm)) {
    // Numeric search, look in 'item_unique_no' column
    $query = "SELECT i.item_id, i.item_name, i.item_unique_no, i.sale_price, i.quantity_in_stock, q.qr_code_image 
              FROM items i
              LEFT JOIN qrcodes q ON i.item_id = q.item_id
              WHERE i.item_unique_no = '$searchTerm'";
    
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Item found, send back the item details as JSON response
        $items = array();
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        echo json_encode(array('status' => 'success', 'data' => $items));
    } else {
        // Item not found
        echo json_encode(array('status' => 'error', 'message' => 'Item not found.'));
    }
} else {
    // Alphabetical search, suggest related items
    $suggestions = array();

    // Query the database for items related to the search term (item_name)
    $query = "SELECT i.item_id, i.item_name, i.item_unique_no, i.sale_price, i.quantity_in_stock, q.qr_code_image 
                FROM items i
                LEFT JOIN qrcodes q ON i.item_id = q.item_id
                 WHERE i.item_name LIKE '%$searchTerm%' LIMIT 10";
    
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $suggestions[] = $row;
        }
    }

    echo json_encode(array('status' => 'suggestions', 'data' => $suggestions));
}

// Close the database connection
$conn->close();
?>

