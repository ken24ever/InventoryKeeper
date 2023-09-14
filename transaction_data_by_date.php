<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include('connection.php');

// Get the selected date from the request
$date = isset($_GET['date']) ? $_GET['date'] : '';

// Convert the date to the proper format (YYYY-MM-DD)
$date = date('Y-m-d', strtotime($date));

// Get the start and end dates of the selected month
$startDate = date('Y-m-01', strtotime($date));
$endDate = date('Y-m-t', strtotime($date));

// Pagination settings
$perPage = 100; // Number of transactions per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
$offset = ($page - 1) * $perPage; // Calculate the offset for SQL query

// Fetch transactions for the selected month with pagination
$query = "SELECT t.transaction_id, t.transaction_date, t.profit_loss, t.item_id, i.item_name, i.item_description, i.purchase_price, i.sale_price, i.quantity_in_stock, t.transaction_type, t.quantity, t.total_amount
          FROM transactions t
          JOIN items i ON t.item_id = i.item_id
          WHERE t.transaction_date BETWEEN ? AND ?
          LIMIT $perPage OFFSET $offset";

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind the parameters
$stmt->bind_param("ss", $startDate, $endDate);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Create an array to hold the transactions
$transactions = array();

// Fetch the transactions
while ($row = $result->fetch_assoc()) {
  $transactions[] = $row;
}

// Close the statement
$stmt->close();

// Retrieve the total number of transactions
$totalQuery = "SELECT COUNT(*) AS total
               FROM transactions t
               JOIN items i ON t.item_id = i.item_id
               WHERE t.transaction_date BETWEEN ? AND ?";
$totalStmt = $conn->prepare($totalQuery);
$totalStmt->bind_param("ss", $startDate, $endDate);
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
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
$totalStmt->close();
$conn->close();
?>
