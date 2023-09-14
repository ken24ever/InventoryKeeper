<?php
// Include the database connection
include('connection.php');

// Retrieve role data from the database
$stmt = $conn->prepare("SELECT * FROM roles");
$stmt->execute();
$result = $stmt->get_result();

// Fetch the role records
$roles = $result->fetch_all(MYSQLI_ASSOC);

// Close the statement and connection
$stmt->close();
$conn->close();

// Send the role data as JSON response
header('Content-Type: application/json');
echo json_encode($roles);
exit();
?>
