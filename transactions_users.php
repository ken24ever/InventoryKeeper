<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include('connection.php');

// Pagination settings
$perPage = 5; // Number of transactions per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
$offset = ($page - 1) * $perPage; // Calculate the offset for SQL query

// Filter criteria
$transactionType = $_GET['transactionType'];
$transactionUser = $_GET['transactionUser'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

// Prepare the SQL query with filters
$query = "SELECT t.transaction_id, u.username, i.item_name, t.transaction_date, t.transaction_type, t.quantity, t.total_amount, t.profit_loss, i.purchase_price
          FROM transactions t
          JOIN users u ON t.user_id = u.user_id
          JOIN items i ON t.item_id = i.item_id
          WHERE 1=1";

// Apply filters
if (!empty($transactionType)) {
  $query .= " AND t.transaction_type = '$transactionType'";
}
if (!empty($transactionUser)) {
  $query .= " AND u.username = '$transactionUser'";
}
if (!empty($startDate)) {
  $query .= " AND t.transaction_date >= '$startDate'";
}
if (!empty($endDate)) {
  $query .= " AND t.transaction_date <= '$endDate'";
} 

// Add sorting criteria
$query .= " ORDER BY t.transaction_date DESC";

// Add pagination
$query .= " LIMIT $perPage OFFSET $offset";

$result = $conn->query($query);

// Create an array to hold the transactions
$transactions = array();

// Check if there are any transactions
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Add each transaction to the array
    $transactions[] = $row;
  }
}

// Retrieve the total number of transactions (without filters)
$totalQuery = "SELECT COUNT(*) AS total FROM transactions";
$totalResult = $conn->query($totalQuery);
$totalRows = $totalResult->fetch_assoc();
$totalTransactions = $totalRows['total'];

// Calculate the total number of pages
$totalPages = ceil($totalTransactions / $perPage);

// Prepare the JSON response
$response = array(
  'transactions' => $transactions,
  'total_pages' => $totalPages
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
