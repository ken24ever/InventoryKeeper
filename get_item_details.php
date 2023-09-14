<?php
// Include the database connection
include('connection.php');

if (isset($_GET['itemId'])) {
  $itemId = intval($_GET['itemId']);

  // Retrieve the item details from the database based on the item ID
  $query = "SELECT * FROM items WHERE item_id = $itemId";
  $result = $conn->query($query);

  if ($result && $result->num_rows > 0) {
    $itemDetails = $result->fetch_assoc();

    // Return the item details as a JSON response
    echo json_encode($itemDetails);
  } else {
    // Return an error response if item not found
    echo json_encode(array('error' => 'Item not found.'));
  }
} else {
  // Return an error response if item ID is not provided
  echo json_encode(array('error' => 'Item ID not provided.'));
}

// Close the database connection
$conn->close();
?>
