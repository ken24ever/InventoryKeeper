<?php
session_start();

if (isset($_SESSION['user_id'])){
  $userID = $_SESSION['user_id'] ;
  $userName = $_SESSION['username'];
  $userRole =  $_SESSION['role'] ;
}
else {
  header("location:inventoryKeeper/logout.php");
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IKA Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

   <!-- toast styling effect -->
<link rel="stylesheet" href="node_modules/toastify-js/src/toastify.css" />

<!-- highcharts lib -->
<!-- <script src="highchartsLib/code/highcharts.js"></script>
<script src="highchartsLib/code/modules/accessibility.js"></script>
 -->
  <!-- sweet  alert 2 lib -->
<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- jQuery library -->
<script src="jquery/jquery-3.6.0.min.js"></script> 

<!-- FileSaver -->
<script src="FileSaver.js/dist/FileSaver.js"></script>

<!-- Custom JS files -->
<!-- <script src="js/superCreate_user.js"></script> -->
<script src="js/transactions_users.js"></script>
<!-- <script src="js/transactionsCharts.js"></script> -->

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.php"><img src="images/logo-mini.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo-mini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <i class="icon-head menu-icon"></i>
                <span class="menu-title">Admin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <!-- <a class="dropdown-item" href="https://igs.ng/pos/logout.php"> -->
              <a class="dropdown-item" href="logout.php">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a> 
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="superAdmin.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transactions.php">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Transactions</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manage_user.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Managment</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Transaction Tracking</p>
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
                    <div class="col-12">
                    <center><!-- Pagination Links -->
                       
                        <div id="paginationContainer">
                          
                        </div>

                    </center>
                      <div class="table-responsive">
                        <table  class="display expandable-table table-striped" style="width:100%">
                          <thead>
                            <tr>
                              <th>Transaction ID</th>
                              <th>User</th>
                              <th>Item</th>
                              <th>Date</th>
                              <th>Type</th>
                              <th>Quantity</th>
                              <th>Total Amount</th>
                              <th>Purchase Price</th>
                              <th>Profit/Loss</th>
                              <th></th> 
                            </tr>
                          </thead>
                          <tbody id="transactionTableBody">
                             <!-- Transaction data will be dynamically populated using AJAX -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
          </div>
<!--           <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Transaction Chart</h4>
                    <div class="form-group">
                      <label for="category">Transaction Type</label>
                        <select class="form-control" id="category">
                          <option value="">All</option>
                          <option value="sale">Sale</option>
                          <option value="purchase">Purchase</option>
                          <option value="adjustment">Adjustment</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="start_Date">Start Date</label>
                      <input type="date" id="start_Date" name="start_Date" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="end_Date">End Date</label>
                      <input type="date" id="end_Date"  name="end_Date"class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Create User</button>
                </div>
              </div>
            </div>
          </div> -->
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.  Inventory Keeper Apptstrap. All rights reserved.</span>
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>
</html>