<?php


// Start a new session or resume the existing session
session_start();

// Include the database connection
include('connection.php');

// Check if the connection was successful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// Pagination settings
$perPage = 5; // Number of users per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Convert $page to an integer
$offset = ($page - 1) * $perPage; // Calculate the offset for SQL query


// Retrieve user data from the database with pagination
$userRole = $_SESSION['role']; // Assuming you have stored the user role in a session variable
if ($userRole == 'Admin') {
  // If the user role is 'Admin', exclude the 'super user' role from the query
  $stmt = $conn->prepare("SELECT u.user_id, u.username, r.role_name FROM users u INNER JOIN roles r ON u.role_id = r.role_id WHERE r.role_name <> 'Super Admin' ORDER BY u.user_id DESC LIMIT ?, ? ");
} else {
  // For other roles, include all records in the query
  $stmt = $conn->prepare("SELECT u.user_id, u.username, r.role_name FROM users u INNER JOIN roles r ON u.role_id = r.role_id ORDER BY u.user_id DESC LIMIT ?, ? ");
}

 
$stmt->bind_param("ii", $offset, $perPage);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the user records
$users = $result->fetch_all(MYSQLI_ASSOC); 


// Close the statement
$stmt->close();

// Retrieve the total number of users
$totalQuery = "SELECT COUNT(*) AS total FROM users";
$totalResult = $conn->query($totalQuery);
$totalRows = $totalResult->fetch_assoc();
$totalUsers = $totalRows['total'];


// Calculate the total number of pages
$totalPages = ceil($totalUsers / $perPage);

// Prepare the JSON response
$response = array(
  'users' => $users,
  'totalPages' => $totalPages
);

// Generate the pagination links
$pagination = '';
/* if ($totalPages > 1) {
  $pagination .= '<ul class="pagination">';
  if ($page > 1) {
    $prevPage = $page - 1;
    $pagination .= '<li class="pagination-link page-item" id="'.$prevPage.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
  }

   

  for ($i = 1; $i <= $totalPages; $i++) {
    $pagination .= '<li class="pagination-link page-item " data-page="' . $i . '" ><span class="page-link">'.$i.'</span></li>';;
    
  }
  if ($page < $totalPages) {
    $nextPage = $page + 1;
    $pagination .= '<li class="pagination-link page-item"  data-page="' . $nextPage . '"><span class="page-link"><i  class="fa fa-arrow-right" ></i></span></li>';
    
  }
  $pagination .= '</ul>';
} */

// Determine the start and end of the pagination sequence
$start_page = $page - 5;
if ($start_page < 1) {
   $start_page = 1;
}
$end_page = $start_page + 9;
if ($end_page > $totalPages) {
   $end_page = $totalPages;
   $start_page = $end_page - 9;
   if ($start_page < 1) {
       $start_page = 1;
   }
}

$pagination .= '<ul class="pagination">';
// Add link to the first page
if ($page > 1){
  $previous = $page-1;
 
  $pagination .= '<li class="pagination-link  page-item" id="'.$previous.'" title="'.$previous.'" ><span class="page-link"><i class="fa fa-arrow-left">Previous</i></span></li>';
 }

// Always show the first page
if ($page > 3){
  $pagination .= '<li class="pagination-link page-item" id="1"><a class="page-link" href="javascript:void(0);">1</a></li>';
 }
 if ($page > 4){
  $pagination .= '<li class="pagination-link page-item disabled"><a class="page-link" href="javascript:void(0);">...</a></li>';
 }
 for ($i=max(2, $page-2); $i<=min($totalPages-1, $page+2); $i++){
  $active_class = "";
  if ($i == $page){
    $active_class = "active";
  }
  $pagination .= '<li class="pagination-link page-item '.$active_class.'" id="'.$i.'" title="'.$i.'"  ><a class="page-link" href="javascript:void(0);">'.$i.'</a></li>';
 }
 if ($page < $totalPages-3){
  $pagination .= '<li class="pagination-link page-item disabled"><a class="page-link" href="javascript:void(0);">...</a></li>';
 }
 if ($page < $totalPages-2){
  $pagination .= '<li class="pagination-link page-item" id="'.$totalPages.'" title="'.$totalPages.'"><a class="page-link" href="javascript:void(0);">'.$totalPages.'</a></li>';
 }
 
 if ($page < $totalPages){
  $next = $page+1;
  $pagination .= '<li class="pagination-link page-item" data-page="'.$next.'" title="'.$next.'" ><span class="page-link"><i  class="fa fa-arrow-right" >Next</i></span></li>';
 }

 $pagination .= '</ul>';
// Append the pagination links to the JSON response
$response['pagination'] = $pagination;

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
