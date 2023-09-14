<?php
// Include the database connection
include('connection.php');

// Get the sales data for the last 30 days
$query = "SELECT DATE(transaction_date) AS date, SUM(quantity) AS total_sales 
          FROM transactions 
          WHERE transaction_type = 'sale' AND transaction_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) 
          GROUP BY DATE(transaction_date)";
$result = $conn->query($query);

// Create an array to hold the data
$data = array();

// Loop through the result and add data to the array
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'date' => $row['date'],
        'totalSales' => $row['total_sales']
    );
}

// Return the data as JSON
echo json_encode($data);
?>
