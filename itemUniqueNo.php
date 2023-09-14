<?php

 
// Define variables and initialize with empty values
$vehicleRegNum = $password = $output_msg ="";
 
// Processing form data when form is submitted
if( isset($_POST['itemUniqueNo'])){
     
   


// Include the database connection
include('connection.php');

      //now we validate data from javascript
      function test_input($data) {
        $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
        return $data;
          } //end of test_input

          //now assign variables locally
          $itemUniqueNo = test_input($_POST["itemUniqueNo"]); 
         
   

    
        // Prepare a select statement
        $sql = "SELECT * FROM items WHERE item_unique_no = ?";

          $stmt = mysqli_stmt_init($conn);
         $get_stmt_prepared= mysqli_stmt_prepare($stmt, $sql);

        if(!$get_stmt_prepared){
            $output_msg .= "SQL statement failed!";
           // return false;
        }
        else{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $itemUniqueNo);
            // execute query
            mysqli_stmt_execute($stmt) ; 
            //here get results from query          
            $result = mysqli_stmt_get_result($stmt);
          
            //loop
           while($row = mysqli_fetch_assoc($result)){
             
             $item_uniqueID  = $row['item_unique_no'];
           
                    

                        
            } //end of while loop

                    if (mysqli_num_rows($result)  > 0 ){
             
             /*      header("location:dashboard.php"); */
               $output_msg .= 1 ;  
                
            } else if (mysqli_num_rows($result) < 1 ){

                        $output_msg .= 0 ;
                      
                    }

                
                    echo $output_msg;
                   
                    
         

           
            
         }// end of  else stmt
            
    
     

            // Close connection
            mysqli_close($conn);

        }// end of if isset  





   


?>