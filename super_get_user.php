<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user ID from the form submission
  $user_id = $_POST['user_id'];

  // Include the database connection
  include('connection.php');

  // Prepare the SQL statement
  $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");

  // Bind parameters and execute the statement
  $stmt->bind_param("i", $user_id);
  $stmt->execute();

  // Bind the result to variables
  $stmt->bind_result($user_id, $username, $password, $role_id);
  $stmt->fetch();

  // Close the statement and connection
  $stmt->close();
  $conn->close();

  // Prepare the JSON response
  $response = array(
    'success' => true,
    'user' => array(
      'user_id' => $user_id,
      'username' => $username,
      'role_id' => $role_id
    )
  );

  // Send the JSON response
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}
?>
