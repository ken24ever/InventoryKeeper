<?php
// Include the database connection
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the item data from the POST request
  $itemId = isset($_POST['itemID']) ? intval($_POST['itemID']) : '';
  $itemName = isset($_POST['itemName']) ? $_POST['itemName'] : '';
  $itemDescription = isset($_POST['itemDescription']) ? $_POST['itemDescription'] : '';
  $itemPrice = isset($_POST['itemPrice']) ? floatval($_POST['itemPrice']) : '';
  $itemSalePrice = isset($_POST['itemSalePrice']) ? floatval($_POST['itemSalePrice']) : '';
  $itemQuantity = isset($_POST['itemQuantity']) ? intval($_POST['itemQuantity']) : '';
  $itemStatus = isset($_POST['itemStatus']) ? $_POST['itemStatus'] : '';
  $categorySelect = isset($_POST['category_Select']) ? $_POST['category_Select'] : '';

  // Validate and sanitize input data (optional, can be done client-side as well)
  $itemName = trim($itemName);
  $itemDescription = trim($itemDescription);

  // Update the item details in the database
  $query = "UPDATE items SET item_name = '$itemName', item_description = '$itemDescription', purchase_price = '$itemPrice', sale_price = '$itemSalePrice', quantity_in_stock = '$itemQuantity', status = '$itemStatus', category = '$categorySelect' WHERE item_id = '$itemId'";

  if ($conn->query($query) === TRUE) {
    // Return success response
    echo json_encode(array('success' => true, 'message' => 'Item updated successfully.'));
  } else {
    // Return error response
    echo json_encode(array('success' => false, 'message' => 'Error updating item data: ' . $conn->error));
  }
} else {
  // Return an error response for invalid request method
  echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}

// Close the database connection
$conn->close();
?>
