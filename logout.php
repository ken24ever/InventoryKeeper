<?php
session_start();

// Include the database connection
include('connection.php');

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Invalidate the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Close the database connection (if not already closed in connection.php)
// $conn->close(); // Uncomment this line if needed

// Redirect to the index page
header("location: index.php");
exit();
?>
