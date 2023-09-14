<?php
// Include the database connection
include('connection.php');

// Query to get total count of users
$sql = "SELECT COUNT(user_id) AS user_count FROM users";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$userCount = $row['user_count'];

$response = array(
    "total_users" => $userCount
);

header("Content-Type: application/json");
echo json_encode($response);

$conn->close();
?>
