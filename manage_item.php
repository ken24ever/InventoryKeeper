<?php
session_start();

if (isset($_SESSION['user_id'])){
  $userID = $_SESSION['user_id'] ;
  $userName = $_SESSION['username'];
  $userRole =  $_SESSION['role'] ;
}
else {
  header("location:logout.php");
}
?>
<!DOCTYPE html>
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

  <!-- custom js files -->
  <script src="js/view_item.js"></script>

  <style>
  .accordion {
    background-color: #f5f5f5;
    color: #333;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 18px;
    transition: 0.4s;
  }

  .active, .accordion:hover {
    background-color: #ddd;
  }

  .accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
  }

  /*.active:after {*/
  /*  content: "\2212";*/
  /*}*/

  .panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
  }
</style>
</head>
<body>
      <!-- toast effect -->
<script src="node_modules/toastify-js/src/toastify.js"></script>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="store_keeper.php"><img src="images/logo-mini.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="store_keeper.php"><img src="images/logo-mini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <span class="menu-title"><i class="icon-head menu-icon"></i>  [ <?php echo $_SESSION['username'];?> ]</span>
                <span class="menu-title">Store Keeper</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
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
            <a class="nav-link" href="store_keeper.php">
              <i class="icon-plus menu-icon"></i>
              <span class="menu-title">Add Items</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manage_item.php">
              <i class="icon-gear menu-icon"></i>
              <span class="menu-title">Manage Items</span>
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
                  <p class="card-title">View Item</p>
                  <div class="row">
                    <div class="col-md-12">
                    <div id="paginationContainer"></div>
                      <div class="form-group">
                        <input type="text" id="category" name="category" class="form-control" placeholder="Search Items In Stock!">
                      </div>
                    </div>
                    <div class="col-12">
                  
                    <div class="responsive overflow-auto" style="max-height: 500px;">
                    <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>Item ID</th>
                                  <th>Bar Code No.</th>
                                  <th>Item Name</th>
                                  <th>Description</th>
                                  <th>Purchase Price</th>
                                  <th>Sale Price</th>
                                  <th>Status</th>
                                  <th>Category</th>
                                  <th>Quantity in Stock</th>
                                  <th>Actions</th> 
                              </tr>
                          </thead>
                          <tbody id="itemsTableBody" >
                              <!-- Table rows will be added here by jQuery -->
                          </tbody>
                      </table>
                     </div>
                    </div>
                  </div>
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
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



    <!-- The Modal -->
    <div class="modal" id="editItemModal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h2 class="modal-title">Edit Item</h2>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form id="editItemForm" >
          <input type="hidden" name="itemID" id="itemID">
          <div class="form-group">
            <label for="itemName">Item Name:</label>
            <input type="text" class="form-control" id="itemName" name="itemName" required>
          </div>

          <div class="form-group">
            <label for="itemDescription">Item Description:</label>
            <textarea class="form-control" id="itemDescription" name="itemDescription"></textarea>
          </div>

          <div class="form-group">
            <label for="itemPrice">Price:</label>
            <input type="number" class="form-control" id="itemPrice" name="itemPrice" min="0" step="0.01" required>
          </div>

          <div class="form-group">
            <label for="itemSalePrice">Sale Price:</label>
            <input type="number" class="form-control" id="itemSalePrice" name="itemSalePrice" min="0" step="0.01" required>
          </div>

          <div class="form-group">
            <label for="itemQuantity">Quantity:</label>
            <input type="number" class="form-control" id="itemQuantity" name="itemQuantity" min="0" required>
          </div>

          <div class="form-group">
            <label for="itemStatus">Status:</label>
         <!--    <select class="form-control" id="itemStatus" name="itemStatus" required readonly>
              <option value="PURCHASE">Purchase</option>
              <option value="ADJUSTMENT">Adjustment</option>
              <option value="SALE">Sale</option>
            </select> -->
            <input type="text" class="form-control" id="itemStatus" name="itemStatus" required readonly>
          </div>

          <div class="form-group">
            <label for="cate">Select Item Category:</label>
            <select id="category_Select" name="category_Select" class="form-control" required>
  <option value="">Select Category</option>
  <option value="Electronics">Electronics</option>
  <option value="Clothing">Clothing</option>
  <option value="Furniture">Furniture</option>
  <option value="Kitchenware">Kitchenware</option>
  <option value="Toys">Toys</option>
  <option value="Books">Books</option>
  <option value="Sports Equipment">Sports Equipment</option>
  <option value="Office Supplies">Office Supplies</option>
  <option value="Beauty and Personal Care">Beauty and Personal Care</option>
  <option value="Home Decor">Home Decor</option>
  <option value="Automotive">Automotive</option>
  <option value="Pet Supplies">Pet Supplies</option>
  <option value="Health and Wellness">Health and Wellness</option>
  <option value="Food and Groceries">Food and Groceries</option>
  <option value="Garden and Outdoor">Garden and Outdoor</option>
  <option value="Others">Others</option>
</select>
          </div>

          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>


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

  <script>
  // Get the input element
  var itemUniqueNoInput = document.getElementById('itemUniqueNo');

  // Add an event listener for the input event
  itemUniqueNoInput.addEventListener('input', function(event) {
    // Get the input value
    var inputValue = event.target.value;

    // Remove any non-numeric characters
    var numericValue = inputValue.replace(/\D/g, '');

    // Check if the numeric value is more than 13 digits
    if (numericValue.length > 13) {
      // Trigger an error, you can display an error message or perform other actions
     // alert("Input should not exceed 13 digits!");
      Toastify({
  text: 'Input should not exceed 13 digits!',
  duration: 5000,
  gravity: 'top',
  close: true,
  style: {
    background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
  }
}).showToast();
      // Trim the value to 13 digits
      numericValue = numericValue.slice(0, 13);
    }

    // Update the input value
    event.target.value = numericValue;
  });
</script>
</body>
</html>