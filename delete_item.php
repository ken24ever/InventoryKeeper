<?php
// Include the database connection
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the item ID from the POST request
  $itemId = isset($_POST['itemId']) ? intval($_POST['itemId']) : '';

  // Check if the item exists in the database
  $checkQuery = "SELECT COUNT(*) AS count FROM items WHERE item_id = $itemId";
  $result = $conn->query($checkQuery);
  $row = $result->fetch_assoc();

  if ($row['count'] === 0) {
    // Return an error response if the item does not exist
    echo json_encode(array('success' => false, 'message' => 'Item not found in the database.'));
    exit;
  }

  // Get the QR code image path from the qrcodes table
  $qrImagePathQuery = "SELECT qr_code_image FROM qrcodes WHERE item_id = $itemId";
  $result = $conn->query($qrImagePathQuery);
  $row = $result->fetch_assoc();

  // Delete the item from the database
  $deleteQuery = "DELETE FROM items WHERE item_id = $itemId";

  if ($conn->query($deleteQuery) === TRUE) {
    // Delete the corresponding QR code image from the directory
    $qrImagePath = $row['qr_code_image'];
    if (file_exists($qrImagePath)) {
      unlink($qrImagePath);
    }

    // Delete the item_id from the qrcodes table
    $deleteQrCodeQuery = "DELETE FROM qrcodes WHERE item_id = $itemId";
    $conn->query($deleteQrCodeQuery);

    // Return success response
    echo json_encode(array('success' => true, 'message' => 'Item deleted successfully.'));
  } else {
    // Return error response
    echo json_encode(array('success' => false, 'message' => 'Error deleting item: ' . $conn->error));
  }
} else {
  // Return an error response for invalid request method
  echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}

// Close the database connection
$conn->close();
?>
