<?php
// Include the database connection
include('connection.php');
include('phpqrcode/qrlib.php');

// Get the item data from the POST request
$itemName = isset($_POST['itemName']) ? $_POST['itemName'] : '';
$itemDescription = isset($_POST['itemDescription']) ? $_POST['itemDescription'] : '';
$itemPrice = isset($_POST['itemPrice']) ? $_POST['itemPrice'] : '';
$itemSalePrice = isset($_POST['salePrice']) ? $_POST['salePrice'] : '';
$itemQuantity = isset($_POST['itemQuantity']) ? $_POST['itemQuantity'] : '';
$itemUniqueNo = isset($_POST['itemUniqueNo']) ? $_POST['itemUniqueNo'] : '';
$categorySelect = isset($_POST['categorySelect']) ? $_POST['categorySelect'] : '';

// Validate and sanitize input data
$itemName = trim($itemName);
$itemDescription = trim($itemDescription);
$itemPrice = floatval($itemPrice);
$itemSalePrice = floatval($itemSalePrice);
$itemQuantity = intval($itemQuantity);
$itemUniqueNo = intval($itemUniqueNo);

// Check if item with the unique number already exists
$query = "SELECT COUNT(*) AS count FROM items WHERE item_unique_no = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $itemUniqueNo);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
  die(json_encode(array('success' => false, 'message' => 'Item with this unique number already exists.')));
}

// Generate the QR code image
$qrCodeImagePath = 'qrCodeImg/' . $itemUniqueNo . '.png';
QRcode::png($itemUniqueNo, $qrCodeImagePath);

// Set the initial status to 'PURCHASE' when a new item is added
$status = 'purchase';

// Insert item data into the database using prepared statement
$query = "INSERT INTO items (status, item_unique_no, item_name, item_description, purchase_price, sale_price, category, quantity_in_stock) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sissddsi", $status, $itemUniqueNo, $itemName, $itemDescription, $itemPrice, $itemSalePrice, $categorySelect, $itemQuantity);

if ($stmt->execute()) {
  // Insert data into qrcodes table
  $qrCodeImagePath = 'qrCodeImg/' . $itemUniqueNo . '.png'; // Separate variable for QR code path
  $qrInsertQuery = "INSERT INTO qrcodes (item_id, qr_code_image) VALUES (LAST_INSERT_ID(), ?)";
  $stmt = $conn->prepare($qrInsertQuery);
  $stmt->bind_param("s", $qrCodeImagePath);

  if ($stmt->execute()) {
    // Return success response
    echo json_encode(array('success' => true, 'message' => 'Item added successfully.'));
  } else {
    // Log the error and return error response
    error_log("Error inserting QR code data: " . $conn->error);
    echo json_encode(array('success' => false, 'message' => 'Error inserting QR code data.'));
  }
} else {
  // Log the error and return error response
  error_log("Error inserting item data: " . $conn->error);
  echo json_encode(array('success' => false, 'message' => 'Error inserting item data.'));
}

// Close the database connection
$stmt->close();
$conn->close();
?>
