<?php
session_start();


// Include the database connection
include('connection.php');


// Function to calculate total sales
function getTotalSales($conn) {
    $sql = "SELECT SUM(total_amount) AS total_sales FROM transactions WHERE transaction_type = 'sale'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_sales'];
}

// Function to calculate current month total sales
function getCurrentMonthTotalSales($conn) {
    $currentMonth = date('Y-m');
    $sql = "SELECT SUM(total_amount) AS current_month_total_sales FROM transactions WHERE transaction_type = 'sale' AND DATE_FORMAT(transaction_date, '%Y-%m') = '$currentMonth'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['current_month_total_sales'];
}

// Function to calculate current day total sales
function getCurrentDayTotalSales($conn) {
    $userID = $_SESSION['user_id'] ;
    $currentDate = date('Y-m-d');
    $sql = "SELECT SUM(total_amount) AS current_day_total_sales FROM transactions WHERE transaction_type = 'sale' AND transaction_date = '$currentDate' AND user_id = '$userID' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['current_day_total_sales'];
}

// Function to calculate yesterday's total sales
function getYesterdayTotalSales($conn) {
    $userID = $_SESSION['user_id'] ;
    $yesterday = date('Y-m-d', strtotime('-1 day'));
    $sql = "SELECT SUM(total_amount) AS yesterday_total_sales FROM transactions WHERE transaction_type = 'sale' AND transaction_date = '$yesterday' AND user_id = '$userID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['yesterday_total_sales'];
}

// Retrieve sales data for various periods
$response = array(
    "total_sales" => getTotalSales($conn),
    "current_month_total_sales" => getCurrentMonthTotalSales($conn),
    "current_day_total_sales" => getCurrentDayTotalSales($conn),
    "yesterday_total_sales" => getYesterdayTotalSales($conn) // New addition
);

header("Content-Type: application/json");
echo json_encode($response);

$conn->close();
?>
