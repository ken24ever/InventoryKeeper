<?php
     // Start a new session or resume the existing session
     session_start();

// Include the database connection
include('connection.php');

// Get the username and password from the POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Validate the login credentials against the users table
$query = "SELECT u.*, r.role_name FROM users u
          JOIN roles r ON u.role_id = r.role_id
          WHERE u.username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // Verify the password using password_verify()
  if (password_verify($password, $row['password'])) {
    // Password is correct, login successful

    // Store user data in session variables
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role_name'];

    $response = array(
      'success' => true,
      'role' => $row['role_name'],
      'message' => 'Login Was Successful!'
    );
  } else {
    // Password is incorrect, login failed
    $response = array('success' => false);
  }
} else {
  // Username not found, login failed
  $response = array('success' => false);
}

// Return the JSON response
echo json_encode($response);
?>
