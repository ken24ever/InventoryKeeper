<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include('connection.php');

// Get the filter values from the request
$category = isset($_GET['category']) ? $_GET['category'] : '';
$start_Date = isset($_GET['start_Date']) ? $_GET['start_Date'] : '';
$end_Date = isset($_GET['end_Date']) ? $_GET['end_Date'] : '';

// Prepare the filter conditions
$categoryCondition = '';
$dateCondition = '';
$params = array();

if (!empty($category)) {
  $categoryCondition = ' AND t.transaction_type = ?';
  $params[] = $category;
}

if (!empty($start_Date) && !empty($end_Date)) {
  $dateCondition = ' AND t.transaction_date BETWEEN ? AND ?';
  $params[] = $start_Date;
  $params[] = $end_Date;
}

// Fetch sales data from the database
$salesQuery = "SELECT DATE_FORMAT(t.transaction_date, '%Y-%m') AS transaction_month, SUM(t.total_amount) AS total_sales 
               FROM transactions t
               JOIN items i ON t.item_id = i.item_id
               WHERE 1" . $categoryCondition . $dateCondition . "
               GROUP BY transaction_month";
$salesStmt = $conn->prepare($salesQuery);

// Dynamically bind the parameters based on the number of elements in $params
$types = str_repeat('s', count($params));
if (!empty($params)) {
  $salesStmt->bind_param($types, ...$params);
}
$salesStmt->execute();
$salesResult = $salesStmt->get_result();
$salesData = array();
while ($row = $salesResult->fetch_assoc()) {
  $salesData['categories'][] = $row['transaction_month'];
  $salesData['sales'][] = floatval($row['total_sales']); 
}


// Fetch inventory data from the database
$inventoryQuery = "SELECT DATE_FORMAT(t.transaction_date, '%Y-%m') AS transaction_month, SUM(i.quantity_in_stock) AS total_quantity
                   FROM transactions t
                   JOIN items i ON t.item_id = i.item_id
                   WHERE t.transaction_id IN (
                     SELECT MAX(transaction_id)
                     FROM transactions
                     GROUP BY item_id, DATE_FORMAT(transaction_date, '%Y-%m')
                   )";

// Check if category condition is not empty and add it to the query
if (!empty($categoryCondition)) {
  $inventoryQuery .= $categoryCondition;
}

// Check if date condition is not empty and add it to the query
if (!empty($dateCondition)) {
  $inventoryQuery .= $dateCondition;
}

$inventoryQuery .= " GROUP BY transaction_month";

$inventoryStmt = $conn->prepare($inventoryQuery);


// Dynamically bind the parameters based on the number of elements in $params
if (!empty($params)) {
  $inventoryStmt->bind_param($types, ...$params);
}
$inventoryStmt->execute();
$inventoryResult = $inventoryStmt->get_result();
$inventoryData = array();
while ($row = $inventoryResult->fetch_assoc()) {
  $inventoryData['categories'][] = $row['transaction_month'];
  $inventoryData['quantity'][] = intval($row['total_quantity']);
} 

// Prepare the JSON response
$response = array(
  'salesData' => $salesData,
  'inventoryData' => $inventoryData
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response); 

// Close the database connection
$conn->close();
?>
