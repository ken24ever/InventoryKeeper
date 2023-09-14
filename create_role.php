<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the role name from the form submission
  $roleName = $_POST['roleName'];

  // Include the database connection
  include('connection.php');

  // Perform any necessary validation and sanitization of the role name
  // Example validation: Role name should not be empty
  if (empty($roleName)) {
    $response = array('success' => false, 'message' => 'Role name cannot be empty');
  } else {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO roles (role_name) VALUES (?)");

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $roleName);
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Set the success response
    $response = array('success' => true, 'message' => 'Role created successfully');
  }

  // Close the database connection
  $conn->close();

  // Send the JSON response
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}
?>
