<?php
session_start();

if (isset($_SESSION['user_id'])){
  $userID = $_SESSION['user_id'] ;
  $userName = $_SESSION['username'];
  $userRole =  $_SESSION['role'] ;
}
else {
  header("logout.php"); 
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
  <script src="highchartsLib/code/highcharts.js"></script>
  <script src="highchartsLib/code/modules/accessibility.js"></script>

    <!-- sweet  alert 2 lib -->
<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- jQuery library -->
<script src="jquery/jquery-3.6.0.min.js"></script> 

<!-- FileSaver -->
<script src="FileSaver.js/dist/FileSaver.js"></script>

  <!-- Custom JS files -->
 <!--  <script src="js/superCreate_user.js"></script> -->
  <script src="js/transactions_users.js"></script>
  <script src="js/transactionsCharts.js"></script> 

</head>
<body>
    <!-- toast effect -->
<script src="node_modules/toastify-js/src/toastify.js"></script>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="superAdmin.php"><img src="images/logo-mini.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="superAdmin.php"><img src="images/logo-mini.png" alt="logo"/></a>
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
             <!--  <a class="dropdown-item" href="https://igs.ng/pos/logout.php"> -->
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
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <?php echo $_SESSION['username'];?></h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</span></h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin transparent">
              <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Sales</p>
                      <p class="fs-30 mb-2 AllSales"></p>
                      <p>All Time Sales</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">This Month</p>
                      <p class="fs-30 mb-2 monthlySales"></p>
                      <p>Total Sales</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Today</p>
                      <p class="fs-30 mb-2 todaySales"></p>
                      <p>Total Sales</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Number of Employees</p>
                      <p class="fs-30 mb-2 totalUsers"></p>
                      <p>Total Users</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

                              <!--  -->

                          

                            <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="category">Transaction Type</label>
                                          <select class="form-control" id="category">
                                            <option value="">All</option>
                                            <option value="sale">Sale</option>
                                            <option value="purchase">Purchase</option>
                                            <option value="adjustment">Adjustment</option>
                                          </select>
                                      </div>
                            </div>

                            <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="start_Date">Start Date</label>
                                        <input type="date" id="start_Date" name="start_Date" class="form-control">
                                      </div>
                            </div>

                            <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="end_Date">End Date</label>
                                        <input type="date" id="end_Date"  name="end_Date"class="form-control">
                                      </div>
                                      <!-- <button type="submit" class="btn btn-primary mr-2">Create User</button> -->
                                  </div>
                              
                              </div>
            
            <!--  -->
           

                    <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <p class="card-title">Sales Report</p>
                          <a href="#" class="text-info">View all</a>
                        </div>
                          <!-- <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p> -->
                          <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                          <!-- <canvas id="sales-chart"></canvas> -->
                          <!--  -->
                          <div id="transactionChartsContainer">
                                    <div id="salesChart"></div>
                                    <div id="inventoryChart"></div>
                         </div>
          <!--  -->

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
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?>.  Inventory Keeper App. All rights reserved.</span>
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

