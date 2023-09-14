<?php
session_start();

if (isset($_SESSION['user_id'])){
  $userID = $_SESSION['user_id'] ;
  $userName = $_SESSION['username'];
  $userRole =  $_SESSION['role'] ;
}
else {
 /*  header("location: https://igs.ng/pos/logout.php");  */
 header("location: logout.php"); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IKA POS</title>
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


      <!-- jquery lib -->
      <script src="jquery/jquery-3.6.0.min.js"></script>

      <style>
    /* Add your CSS styling for the suggestions container and items */
    .suggestions-container {
            position: relative;
        }

        #suggestions {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            position: absolute;
            top: 100%; /* Position suggestions below the input */
            left: 0;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000; /* Ensure the suggestions appear above other elements */
            display: none; /* Hide suggestions by default */
        }

        .suggestion-item {
            cursor: pointer;
            padding: 5px;
            border-bottom: 2px solid #ccc;
            font-family: Maiandra GD !important;
            /* font-weight:bold !important; */
            font-variant:small-caps !important;
            font-size: 14px !important;
            
           
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
            font-size: 17px !important;
            font-weight:400 !important;
            transition: ease-in-out 1s;
            animation: ease-in-out;
            
        }

        /* Style the input field */
.classy-input {
    width: 100%;
    padding: 15px;
    font-size: 18px;
    border: none;
    border-bottom: 2px solid #3498db; /* Highlight bottom border */
    outline: none;
    background-color: #f9f9f9; /* Light background color */
    border-radius: 5px 5px 0 0;
    transition: all 0.3s ease-in-out;
    color: #333; /* Text color */
    font-family: "Helvetica Neue", sans-serif; /* Change the font family */
}

/* Style the placeholder text */
.classy-input::placeholder {
    color: #aaa; /* Placeholder text color */
}

/* On focus, highlight the input field */
.classy-input:focus {
    border-bottom: 2px solid #e74c3c; /* Change border color on focus */
    background-color: #fff; /* Change background color on focus */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
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
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo-mini.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <i class="icon-head menu-icon"></i>
                <span class="menu-title">Sales Manager</span>
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
            <a class="nav-link" href="sales_manager.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pos.php">
              <i class="icon-money menu-icon"></i>
              <span class="menu-title">Initiate Sales</span>
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
                  <h6 class="font-weight-normal mb-0">POS systems ready to initiate!</span></h6>
                </div>
              </div>
            </div>
          </div>


<!--           <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12">
                <div class="card">
                <div class="card-body">
                <form id="searchItemName">
                  <div class="form-group">
                          <label for="itemUniqueCode">Search Item Name:</label>
                          <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Enter Item Name" >
                        </div>
                         <button type="submit" class="btn btn-primary">Search Item</button>
                  </form>
                  </div>
              </div>
                </div>
              </div>
            </div>
          </div> -->
          <!--  -->

   
          <!--  -->

          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">POS</h4>
                    <!-- Left Section - Item Search and Details -->
                      <form id="searchForm">
                          <div class="form-group">
                                <label for="itemUniqueCode">Enter Item by Unique Code or Search By Item Name:</label>

                                <div class="suggestions-container">
                                    <input type="text" class="form-control classy-input" id="itemUniqueCode" name="itemUniqueCode" placeholder="Search for items..." autocomplete="off">
                                    <div id="suggestions" class="suggestions-list">
                                        <!-- Suggestions will appear here -->
                                    </div>
                                </div>
                          </div><!--  -->

                          <div class="form-group">
                          <!-- display suggestions ₦ --> 
                          <span id="suggestions"></span> 
                        </div>
                      
                        <div class="form-group">
                          <label for="item_id">Item ID:</label>
                          <input type="text" class="form-control" id="item_id" name="item_id" readonly>
                        </div>
                        <div class="form-group">
                          <label for="item_name">Item Name:</label>
                          <input type="text" class="form-control" id="item_name" name="item_name" readonly>
                        </div>
                        <div class="form-group">
                          <label for="sale_price">Sale Price:</label>
                          <input type="text" class="form-control" id="sale_price" name="sale_price" readonly>
                        </div>
                        <div class="form-group">
                          <label for="quantity_in_stock">Quantity in Stock:</label>
                          <input type="text" class="form-control" id="quantity_in_stock" name="quantity_in_stock" readonly>
                          
                        </div>
                        <div class="form-group">
                          <label for="qr_code_image">Item QR Code:</label>
                          <img src="img/download.jpeg" id="qr_code_image" class="img-fluid" alt="Item QR Code">
                        </div>
                        
                       <!--  <button type="button" class="btn btn-success btn-block" id="addToCartBtn">Add to Cart</button> -->
                      </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">POS</h4>
                
                      <div id="totalAmount">Total Amount: ₦0.00</div>
        
                      <ul id="cart" class="list-group mb-4">
                        <!-- Cart items will be added here dynamically -->
                      </ul>
                      <button type="button" class="btn btn-primary btn-block" id="previewButton">Preview Items</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewModalLabel">Preview Cart Items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul id="previewCart" class="list-group"></ul>
        <hr>
        <b><span id="tot"></span></b>
        <hr>
        <br>
        <br>
        <form id="paymentForm">
          <div class="form-group">
            <label for="modeOfPayment">Mode of Payment</label>
            <select class="form-control" id="modeOfPayment" name="modeOfPayment">
              <option value="cash">Cash</option>
              <option value="pos">POS</option>
              <option value="mobile_transfer">Mobile Transfer</option>
            </select>
          </div>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="finalSubmitBtn" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.  Inventory Keeper App. All rights reserved.</span>
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

  <script>
  $(document).ready(function() {

// Handle form submission for searching items with autocomplete
$(document).on('input', '#searchForm', function (e) {
  e.preventDefault();
  var searchTerm = $('#itemUniqueCode').val();


  // Make an AJAX request to fetch item suggestions
  $.ajax({
    url: 'item_details.php',
    type: 'GET',
    data: { searchTerm: searchTerm },
    dataType: 'json',
    success: function (response) {

      

      if (response.status === 'success') {
        var item = response.data;

        // Prefill the item details form
        $('#item_id').val(item[0].item_id);
        $('#item_name').val(item[0].item_name);
        $('#sale_price').val(item[0].sale_price);
        $('#quantity_in_stock').val(item[0].quantity_in_stock);
        $('#qr_code_image').attr('src', item[0].qr_code_image);
        $('#itemUniqueCode').val('');

       // console.log(item[0].item_name);

        // Hide suggestions
        $('#suggestions').hide();

        // Call function to add to cart
        addToCart();
      } else if (response.status === 'suggestions') {
        // Handle autocomplete suggestions
        var suggestions = response.data;
        var suggestionsHtml = '';
     
          

        // Generate HTML for suggestions
        $.each(suggestions, function (index, suggestion) {
          suggestionsHtml += '<div class="suggestion-item">' + suggestion.item_name + '</div>';

             //hide sugg when input field is empty
             if (searchTerm === ''){
              suggestionsHtml ='';
              $('#suggestions').hide();
          }
        });


        // Display suggestions and handle click on suggestion
        $('#suggestions').html(suggestionsHtml).show();
        $('.suggestion-item').on('click', function () {
          var selectedSuggestion = $(this).text();
          $('#itemUniqueCode').val(selectedSuggestion);
          $('#suggestions').hide();

          
        


          // Prefill the item details form from the selected suggestion
          var suggestion = suggestions.find(function (s) {
            return s.item_name === selectedSuggestion;
          });
          if (suggestion) {
            $('#item_id').val(suggestion.item_id);
            $('#item_name').val(suggestion.item_name);
            $('#sale_price').val(suggestion.sale_price);
            $('#quantity_in_stock').val(suggestion.quantity_in_stock);
            $('#qr_code_image').attr('src', suggestion.qr_code_image);
            $('#itemUniqueCode').val('');
          }

          // Call function to add to cart
          addToCart();
        });

        // Clear item details form
        $('#item_id').val('');
        $('#item_name').val('');
        $('#sale_price').val('');
        $('#quantity_in_stock').val('');
        $('#qr_code_image').attr('src', 'img/download.jpeg');
      } else {
        // Handle error response
        Toastify({
          text: response.message,
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
        return false;
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    }
  });
});


// Handle form submission for searching items name
   /*  $(document).on('submit','#searchItemName', function(e) {
      e.preventDefault();
   
      var itemName = $('#itemName').val();
         
      if (itemName == ""){
        Toastify({
          text: 'Input Field Must Have A Valid Entry!',
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
      return false;
      } 

      // Make an AJAX request to fetch item details
      $.ajax({
        url: 'item_details.php', 
        type: 'GET',
        data: {  itemName:itemName },
        dataType: 'json',
        success: function(response) {

          if (response.status === 'success') {
            var item = response.data;
                     // Prefill the item details form
          $('#item_id').val(item.item_id);
          $('#item_name').val(item.item_name);
          $('#sale_price').val(item.sale_price);
          $('#quantity_in_stock').val(item.quantity_in_stock);
          $('#qr_code_image').attr('src', item.qr_code_image);
          $('#itemName').val('');
        

          //call function to add to cart
            addToCart()
          }

          else{
            Toastify({
          text: response.message,
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
      return false;
          }

        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });
 */
    // Handle adding items to the cart

  // Initialize the total amount
  var totalAmount = 0.0;

  function addToCart(){
    var item_id = $('#item_id').val();
    var item_name = $('#item_name').val();
    var sale_price = parseFloat($('#sale_price').val());
    var quantity_in_stock = parseInt($('#quantity_in_stock').val());
    var transaction_mode = $('#transaction_mode').val();
    var qr_code_image = $('#qr_code_image').attr('src');

    if (quantity_in_stock === 0){
  
      Toastify({
          text: 'Item Quantity Is Empty, Item Needs Restocking!',
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
      return false;
    }

 
    // Create a new cart item and append it to the cart
    var cartItem = '<li id="' + item_id + '" class="list-group-item d-flex justify-content-between" data-sale-price="' + sale_price + '" >';
    cartItem += '<div><strong>' + item_name + '</strong><br>Price: ₦' + sale_price + '</div>';
    cartItem += '<div>Quantity: <input type="number" min="1" max="' + quantity_in_stock + '" value="1" class="cart-item-quantity" data-quantity="1" data-quantity-in-stock="' + quantity_in_stock + '"> ';
    cartItem += '<button type="button" class="btn btn-danger btn-sm cart-item-remove">Remove</button></div>';
    cartItem += '<div class="cart-item-price">₦' + sale_price + '</div>'; // Add the cart-item-price element here
    cartItem += '</li>';
    $('#cart').append(cartItem);

    console.log(item_id)
    // Update the total amount
    totalAmount += parseFloat(sale_price);
    console.log("Total amount:", totalAmount);
    updateTotalAmountDisplay();
  

  }


    
  // Handle removing items from the cart
  $(document).on('click', '.cart-item-remove', function() {
    var cartItem = $(this).closest('li');
    var salePrice = parseFloat(cartItem.data('sale-price'));

    // Update the total amount
    totalAmount -= salePrice;
    updateTotalAmountDisplay();

    // Remove the cart item from the cart
    cartItem.remove();
  });
  
// Handle changing the quantity of items in the cart
$(document).on('input', '.cart-item-quantity', function() {
  var cartItem = $(this).closest('li');
  var salePrice = parseFloat(cartItem.data('sale-price'));
  var quantity = parseInt($(this).val(), 10);
  var prevQuantity = parseInt($(this).data('quantity'), 10);

  console.log("Changing quantity:", quantity);

  // Update the total amount
  totalAmount += (quantity - prevQuantity) * salePrice;

  //console.log("Total amount:", totalAmount);

  // Update the data-quantity attribute to the new quantity value
  $(this).data('quantity', quantity);

  // Update the total amount display
  updateTotalAmountDisplay();
});



  // Function to update the total amount display
  function updateTotalAmountDisplay() {
    $('#totalAmount').text('Total Amount: ₦' + totalAmount.toFixed(2));
  }



  // Handle final submission of the cart
  $(document).on('click', '#previewButton', function() {
    // Get cart items and submit to process_sale.php
    var cartItems = [];
    var TotalAmount = $('#totalAmount').text();
        var getTot = $('#tot');
        getTot.text(TotalAmount);
    // Loop through each cart item and push it to cartItems array
    $('#cart li').each(function() {
      var item_name = $(this).find('strong').text();
      var quantity = parseInt($(this).find('.cart-item-quantity').val(), 10);
      var salePrice = parseFloat($(this).data('sale-price'));
      var userID = <?php echo $_SESSION['user_id'] ; ?>

      var totalItemSale = (quantity * salePrice);

      cartItems.push({ item_name: item_name, totalItemSale: totalItemSale, quantity: quantity, userID: userID, salePrice:salePrice });

      if (quantity === 0) {
     
        Toastify({
          text: 'Oops! Item Quantity Cannot Be Zero.',
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
      
        return false;
      }
    });

    if (cartItems.length === 0) {
     

      Toastify({
          text: 'Oops! Empty Cart, Add An Item.',
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
      
      
      return false;
    }

    // Show preview modal
    $('#previewCart').empty(); // Clear any existing items in the preview modal
    cartItems.forEach(function(item) {
      var listItem = '<li class="list-group-item">' + item.item_name + ' x ' + item.quantity +  ' (' + item.salePrice + ') ₦' + item.totalItemSale + '</li>';
   
      $('#previewCart').append(listItem);
    });
    $('#previewModal').modal('show');
  });

  // Handle final submission after preview
  $(document).on('click', '#finalSubmitBtn', function() {
    // Get selected mode of payment
    var modeOfPayment = $('#modeOfPayment').val();

    //create an empty array 
    var cartItems = [];

    //loop thru each item on the cart
    $('#cart li').each(function() {
      var item_name = $(this).find('strong').text();
      var quantity = parseInt($(this).find('.cart-item-quantity').val(), 10);
      var salePrice = parseFloat($(this).data('sale-price'));
      var userID = <?php echo $_SESSION['user_id'] ; ?>

      var totalItemSale = (quantity * salePrice);
      
    //here we finally push items to the empty array
      cartItems.push({ item_name: item_name, totalItemSale: totalItemSale, quantity: quantity, userID: userID, salePrice:salePrice, modeOfPayment:modeOfPayment });

      if (quantity === 0) {
       
        Toastify({
          text: 'Oops! Item Quantity Cannot Be Zero.',
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
        return false;
      }
    });

    // Update the cartItems with the mode of payment
   /*  cartItems.forEach(function(item) {
      item.modeOfPayment = modeOfPayment;
    });
 */
    // Make an AJAX request to process_sale.php
    $.ajax({
      url: 'process_sale.php',
      type: 'POST',
      data: { cartItems: JSON.stringify(cartItems) },
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          // Sale processed successfully
          Toastify({
          text: 'Sale processed successfully!',
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
          // Clear the cart and close the modal
          $('#cart').empty();
          $('#salesModal').modal('show');
          $('#previewModal').modal('show');
          // Trigger print command
          window.print();
        } else {
     
          Toastify({
          text: 'Error processing sale. Please try again.',
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  });












  });//end of ready state
</script>



</body>
</html>





