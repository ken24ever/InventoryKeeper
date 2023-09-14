<?php
session_start();

if (isset($_SESSION['user_id'])){
  $userID = $_SESSION['user_id'] ;
  $userName = $_SESSION['username'];
  $userRole =  $_SESSION['role'] ;
}
else {
  header("location: logout.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Super Admin Dashboard</title>
  <!-- Include CSS stylesheets and JS scripts -->
  <!-- Bootstrap, Font Awesome, etc. -->

  <link rel="stylesheet" href="bootstrap_v4/css/bootstrap.min.css">
  <link rel="stylesheet" href="font_awe_6/css/all.css">

        <!-- highcharts lib -->
        <script src="highchartsLib/code/highcharts.js"></script>
      <script src="highchartsLib/code/modules/accessibility.js"></script>

        <!-- sweet  alert 2 lib -->
  <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

	

           <!-- toast styling effect -->
     <link rel="stylesheet" href="node_modules/toastify-js/src/toastify.css" />
    


  <!-- jQuery library -->
  <script src="jquery/jquery-3.6.0.min.js"></script> 

<!-- FileSaver -->
<script src="FileSaver.js/dist/FileSaver.js"></script>

  <!-- Custom JS files -->
  <script src="js/superCreate_user.js"></script>
  <script src="js/transactions_users.js"></script>
  <script src="js/transactionsCharts.js"></script>
  <style>
    .card-header {
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- toast effect -->
<script src="node_modules/toastify-js/src/toastify.js"></script>


  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Super Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" href="#charts">WELCOME  [ <?php echo $_SESSION['username'];?> ] </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Transactions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mt-4"> 
    <h3>Welcome, Super Admin!</h3>

    <div id="successMessage" style="display: none;"></div>
    <div id="errorMessage" style="display: none;"></div>
    <div id="loadingSpinner" style="display: none;">Loading...</div>

    <!-- User Management Section -->
    <div class="accordion" id="accordionUserManagement">
      <div class="card my-4">
        <div class="card-header" data-toggle="collapse" data-target="#collapseUserManagement" aria-expanded="true" aria-controls="collapseUserManagement">
          <h5 class="mb-0">User Management</h5>
        </div>

        <div id="collapseUserManagement" class="collapse show" aria-labelledby="headingUserManagement" data-parent="#accordionUserManagement">
          <div class="card-body">
            <form id="createUserForm">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                  <!-- Options dynamically populated using AJAX -->
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Create User</button>
            </form>
             <hr>
             <center>
             <div id="paginationCont" class="text-center">
  <!-- Pagination links will be dynamically populated here -->
            </div>
             </center>
           

            <!-- User List -->
            <table class="table mt-4">
              <!-- User list table code here -->
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="userTableBody">
                <!-- User data dynamically populated using AJAX -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Transaction Tracking Section -->
    <div class="accordion" id="accordionTransactionTracking">
      <div class="card my-4">
        <div class="card-header" data-toggle="collapse" data-target="#collapseTransactionTracking" aria-expanded="true" aria-controls="collapseTransactionTracking">
          <h5 class="mb-0">Transaction Tracking</h5>
        </div>

        <div id="collapseTransactionTracking" class="collapse show" aria-labelledby="headingTransactionTracking" data-parent="#accordionTransactionTracking">
          <div class="card-body">
            <!-- Transaction tracking UI code here -->
<center><!-- Pagination Links -->
<div id="paginationContainer">
  
</div>

</center>
<div id="tableForTransactionsTracking" class="responsive overflow-auto" style="max-height: 500px;">
  <!-- Content goes here -->

  <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="transactionType">Transaction Type</label>
          <select class="form-control" id="transactionType">
            <option value="">All</option>
            <option value="sale">Sale</option>
            <option value="purchase">Purchase</option>
            <option value="adjustment">Adjustment</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="transactionUser">User</label>
          <select class="form-control" id="transactionUser">
            <option value="">All</option>
            <!-- Options populated dynamically using AJAX -->
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="startDate">Start Date</label>
          <input type="date" class="form-control" id="startDate">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="endDate">End Date</label>
          <input type="date" class="form-control" id="endDate">
        </div>
      </div>
    </div>

      <!-- Transaction Table -->
<table id="transactionTable" class="table mt-4">
  <thead>
    <tr>
      <th>Transaction ID</th>
      <th>User</th>
      <th>Item</th>
      <th>Date</th>
      <th>Type</th>
      <th>Quantity</th>
      <th>Total Amount</th>
      <th>PURCHASE PRICE</th>
      <th>PROFIT/LOSS</th>
    </tr>
  </thead>
  <tbody id="transactionTableBody">
    <!-- Transaction data will be dynamically populated using AJAX -->
  </tbody>
</table>



</div><!-- table overflow -->

        
          </div>
        </div>
      </div>
    </div>

    <!-- Transaction Charts Section -->
    <div class="accordion" id="accordionTransactionCharts">
      <div class="card my-4">
        <div class="card-header" data-toggle="collapse" data-target="#collapseTransactionCharts" aria-expanded="true" aria-controls="collapseTransactionCharts">
          <h5 class="mb-0">Transaction Charts</h5>
        </div>

      

        <div id="collapseTransactionCharts" class="collapse show" aria-labelledby="headingTransactionCharts" data-parent="#accordionTransactionCharts">
          <div class="card-body">
<!--  -->
<div id="transactionFilters">
  <div class="form-group">
    <label for="category">Transaction Type:</label>
    <select id="category" class="form-control">
      <option value="">All</option>
      <option value="sale">Sale</option>
      <option value="purchase">Purchase</option>
      <option value="adjustment">Adjustment</option>
    </select>
  </div>
  <div class="form-group">
    <label for="startDate">Start Date:</label>
    <input type="date" id="start_Date" name="start_Date" class="form-control">
  </div>
  <div class="form-group">
    <label for="endDate">End Date:</label>
    <input type="date" id="end_Date"  name="end_Date"class="form-control">
  </div>
 <!--  <div class="form-group">
    <button id="applyFilters" class="btn btn-primary">Apply Filters</button>
  </div> -->
</div>
<hr>

<!--  -->
          <div id="transactionChartsContainer">
            <div id="salesChart"></div>
            <div id="inventoryChart"></div>
          </div>
            <!-- Add more chart containers as needed -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modal upon clicking a node in the chart stays here-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Transactions for <span id="modalDate"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body responsive overflow-auto" id="modalContent" style="max-height: 500px;">
      
        
        <!-- Transaction Details -->
        <div id="transactionDetails">
          <!-- Content will be dynamically populated here -->
        </div>
      </div>
      <div class="modal-footer">
        <div id="exportBut"></div>
        <div id="modalPagination" class="text-center">
          <!-- Pagination links will be dynamically populated here -->
  </div>
      </div>
    </div>
  </div>
</div>




  <!-- ends here -->

  <!-- Edit User Modal -->
  <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <!-- Modal markup code here -->
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editUserForm">
            <input type="hidden" id="editUserId" name="editUserId">
  
            <div class="form-group">
              <label for="editUsername">Username</label>
              <input type="text" class="form-control" id="editUsername" name="editUsername" required>
            </div>
  
            <div class="form-group">
              <label for="editRole">Role</label>
              <select class="form-control" id="editRole" name="editRole" required>
                <!-- Role options dynamically populated using AJAX -->
              </select>
            </div>
  
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save Changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Include JS scripts (jQuery, AJAX, etc.) -->

  <script src="bootstrap_v4/js/bootstrap.min.js"></script>



</body>
</html>
