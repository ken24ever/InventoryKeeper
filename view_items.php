<?php
// Include the database connection
include('connection.php');

// Pagination settings
$perPage = 25; // Number of transactions per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
$offset = ($page - 1) * $perPage; // Calculate the offset for SQL query

// Fetch all items from the database
$query = "SELECT * FROM items order by item_id desc LIMIT $perPage OFFSET $offset";
$result = $conn->query($query);

// Create an array to store the items data
$items = array();

// Loop through the result set and add each item to the array
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

// Retrieve the total number of items 
$totalQuery = "SELECT COUNT(*) AS total FROM items";
$totalResult = $conn->query($totalQuery);
$totalRows = $totalResult->fetch_assoc();
$totalItems= $totalRows['total'];

// Calculate the total number of pages
$totalPages = ceil($totalItems/ $perPage);


// Prepare the JSON response
$response = array(
    'items' => $items,
    'total_pages' => $totalPages
  );
  
  // Send the JSON response
  header('Content-Type: application/json');


// Return the items data as JSON
echo json_encode($response);

// Close the database connection
$conn->close();

?>
