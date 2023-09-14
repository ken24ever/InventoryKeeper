<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user details from the form submission
  $user_id = $_POST['editUserId'];
  $new_username = $_POST['editUsername'];
  $new_role_name = $_POST['editRole'];
  $userPass = isset($_POST['password']) ? $_POST['password'] : '';
  
 // Hash and salt the password securely
 $hashedPassword = password_hash($userPass, PASSWORD_DEFAULT);

  // Include the database connection
  include('connection.php');

  // Retrieve the role ID based on the role name
  $stmt = $conn->prepare("SELECT role_id FROM roles WHERE role_name = ?");
  $stmt->bind_param("s", $new_role_name);
  $stmt->execute();
  $stmt->bind_result($new_role_id);
  $stmt->fetch();
  $stmt->close();

  // Prepare the SQL statement
  $stmt = $conn->prepare("UPDATE users SET username = ?, role_id = ?, password = ? WHERE user_id = ?");
  $stmt->bind_param("sisi", $new_username, $new_role_id, $hashedPassword, $user_id);
  $stmt->execute();
  $stmt->close();

  // Prepare the JSON response
  $response = array(
    'success' => true,
    'message' => 'User updated successfully'
  );

  // Send the JSON response
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}
?>
