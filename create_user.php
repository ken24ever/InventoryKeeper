<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user details from the form submission
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $role_id = $_POST['role'];

  // Include the database connection
  include('connection.php');

  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)");

  // Hash and salt the password securely
  $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

  // Bind parameters and execute the statement
  $stmt->bind_param("ssi", $user, $hashedPassword, $role_id);
  $stmt->execute();

  // Close the statement and connection
  $stmt->close();
  $conn->close();

  // Prepare the JSON response
  $response = array(
    'success' => true,
    'message' => 'User created successfully'
  );

  // Send the JSON response
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}
?>
