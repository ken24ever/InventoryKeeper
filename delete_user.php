<?php
// Check if the user ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
  // Get the user ID from the form submission
  $user_id = $_POST['user_id'];

  // Include the database connection
  include('connection.php');

  // Prepare the SQL statement
  $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");

  // Bind parameter and execute the statement
  $stmt->bind_param("i", $user_id);
  $stmt->execute();

  // Close the statement and connection
  $stmt->close();
  $conn->close();

  // Prepare the JSON response
  $response = array(
    'success' => true,
    'message' => 'User deleted successfully'
  );

  // Send the JSON response
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}
?>
