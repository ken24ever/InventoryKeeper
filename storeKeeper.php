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
  <title>Store Keeper Dashboard</title>
  <link rel="stylesheet" href="bootstrap_v4/css/bootstrap.min.css">
  <link rel="stylesheet" href="font_awe_6/css/all.css">

     <!-- toast styling effect -->
     <link rel="stylesheet" href="node_modules/toastify-js/src/toastify.css" />
    

    <!-- highcharts lib -->
    <script src="highchartsLib/code/highcharts.js"></script>
      <script src="highchartsLib/code/modules/accessibility.js"></script>
      
  <!-- sweet  alert 2 lib -->
  <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

	
    <!-- jquery lib -->
    <script src="jquery/jquery-3.6.0.min.js"></script> 
  <!-- custom js files -->
  <script src="js/add_item.js"></script>
  <script src="js/view_item.js"></script>
  <script src="js/allChart.js"></script>
</head>
<body>

<!-- toast effect -->
<script src="node_modules/toastify-js/src/toastify.js"></script>


  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Store Keeper Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mr-auto"> 
       
      <li class="nav-item">
      <a class="nav-link" href="#charts">WELCOME  [ <?php echo $_SESSION['username'];?> ] </a>
        </li>
      <li class="nav-item">
          <a class="nav-link" href="#itemAddition">Add Item</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#viewItems">View Items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#charts">Charts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Accordion for different functionalities -->
  <div class="container mt-4">
    <div id="accordion">
      <!-- Item Addition Form -->
      <div class="card">
        <div class="card-header" id="itemAddition">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseItemAddition" aria-expanded="true" aria-controls="collapseItemAddition">
              Item Addition
            </button>
          </h5>
        </div>

        <div id="collapseItemAddition" class="collapse show" aria-labelledby="itemAddition" data-parent="#accordion">
          <div class="card-body">
            <form id="addItemForm" >
              <div class="form-group">
                <label for="itemName">Item Name:</label>
                <input type="text" class="form-control" id="itemName" name="itemName" >
              </div>

              <div class="form-group">
                <label for="itemDescription">Item Description:</label>
                <textarea class="form-control" id="itemDescription" name="itemDescription"></textarea>
              </div>

              <div class="form-group">
                <label for="itemPrice">Price:</label>
                <input type="number" class="form-control" id="itemPrice" name="itemPrice" min="0" step="0.01" >
              </div>

              <div class="form-group">
                <label for="itemSalePrice">Sale Price:</label>
                <input type="number" class="form-control" id="salePrice" name="salePrice" min="0" step="0.01" >
              </div>

              
              <div class="form-group">
                <label for="categorySelect">Item Category:</label>
                <select id="categorySelect" name="categorySelect" class="form-control" >
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

              <div class="form-group">
                <label for="itemQuantity">Quantity:</label>
                <input type="number" class="form-control" id="itemQuantity" name="itemQuantity" min="0" >
              </div>

              <div class="form-group">
                <label for="UniqueNo">Item Unique Number:</label>
                
                <input type="number" class="form-control" id="itemUniqueNo" name="itemUniqueNo" pattern="[0-9]+" maxlength="13">

              </div>

              <button type="submit" class="btn btn-primary">Add Item</button>
            </form>
          </div>
        </div>
      </div>

     <!-- View Items Section -->
<div class="card">
    <div class="card-header" id="viewItems">
        <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseViewItems" aria-expanded="false" aria-controls="collapseViewItems">
                View Items
            </button>
        </h5>
    </div>
    <div id="collapseViewItems" class="collapse" aria-labelledby="viewItems" data-parent="#accordion">
        <div class="card-body">
          <hr>
          <div id="paginationContainer"></div>
          <hr>

          <hr>
          <form >
         <input type="text" id="category" name="category" class="form-control" placeholder="Search Items In Stock!">
         </form>
          <hr>
          <div class="responsive overflow-auto" style="max-height: 500px;">
                    <table class="table">
                          <thead>
                              <tr>
                                  <th>Item ID</th>
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


      <!-- Charts Section -->
      <div class="card">
        <div class="card-header" id="charts">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseCharts" aria-expanded="false" aria-controls="collapseCharts">
              Charts
            </button>
          </h5>
        </div>
        <div id="collapseCharts" class="collapse" aria-labelledby="charts" data-parent="#accordion">
          <div class="card-body">
            <!-- Add the code to display the charts here -->
            <!--  -->
            <div id="inventoryOverviewChartContainer"></div>
            <div id="salesTrendChartContainer"></div>
            <div id="topSellingItemsChartContainer"></div>
            <div id="inventoryValueChartContainer"></div>
            <div id="itemCategoryBreakdownChartContainer"></div>
             <!--  -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modal for edit form  -->
<!-- The Edit Item Modal -->
<div class="modal" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="editItemModalLabel">Edit Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
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
    </div>
  </div>
</div>

  <!-- ends here -->

  <!-- Include necessary JavaScript files -->
  <script src="bootstrap_v4/js/bootstrap.min.js"></script>

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
