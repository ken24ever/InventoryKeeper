<?php
// Include the database connection
include('connection.php');

// Get the cart items from the POST request
$cartItems = json_decode($_POST['cartItems'], true);
 //var_dump($_POST);
// Start a transaction for the sales
$conn->begin_transaction();

try {
  foreach ($cartItems as $cartItem) {
    $item_name = $cartItem['item_name'];
    $totalItemSale = $cartItem['totalItemSale'];
    $itemQuantity = $cartItem['quantity'];
    $userID = $cartItem['userID'];
    $modeOfPayment = $cartItem['modeOfPayment']; // Retrieve mode of payment


    // Fetch the item_id, purchase_price, and quantity_in_stock from the items table using the item_name
    $query = "SELECT item_id,sale_price, purchase_price, quantity_in_stock FROM items WHERE item_name = '$item_name'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $item_id = $row['item_id'];
    $itemSalePrice = $row['sale_price'];
    $purchase_price = $row['purchase_price'];
    $quantity_in_stock = $row['quantity_in_stock'];

    // Calculate the profit
    $profit = ($itemSalePrice - $purchase_price ); 

    // Calculate the total amount for the sale
    $total_amount = $totalItemSale; /*  * $itemQuantity;  */// $itemQuantity is the number of quantity of item for a given iem on the cart


   // Insert the sales transaction into the transactions table
   $query = "INSERT INTO transactions (modeOfPayment, user_id, item_id, transaction_date, transaction_type, quantity, total_amount, profit_loss)
   VALUES ('$modeOfPayment', $userID, $item_id, NOW(), 'sale', $itemQuantity, $total_amount, $profit)";
$conn->query($query);

    // Update the quantity_in_stock in the items table
    $new_quantity_in_stock = $quantity_in_stock - $itemQuantity; // number of item quantities from the cart 
    $query = "UPDATE items SET quantity_in_stock = $new_quantity_in_stock WHERE item_id = $item_id";
    $conn->query($query);
  }

  // Commit the transaction
  $conn->commit();

  // Return a success response
  echo json_encode(array('success' => true));
} catch (Exception $e) {
  // If there is an error, rollback the transaction and return an error response
  $conn->rollback();
  echo json_encode(array('success' => false));
}

// Close the database connection
$conn->close();
?>
