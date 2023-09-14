$(document).ready(function() {
    // Show Password Functionality (Your existing script)
    var loader = $('.loader').hide();
    // Handle form submission
    $("#loginForm").submit(function(event) {
      event.preventDefault();
      var username = $("#adminUsername").val();
      var password = $("#adminPassword").val();
      
      // Check if input fields are not empty
      if (username === '' || password === '') {
        alert('Fields Must Be Filled!');
        return false;
      }
      
      // Make an AJAX request to the login_process.php script
      $.ajax({
        url: "login_process.php",
        type: "POST",
        data: {
          username: username,
          password: password
        },
        dataType: "json",
        beforeSend: function() {
          // Show loading spinner or loading message if desired
          loader.show();
        },
        success: function(response) {
          console.log(response); // Check the response received from the server
          if (response.success) {
            // Login successful, redirect to appropriate page based on role
            var role = response.role.toLowerCase();
            var redirectUrl = "";

            Toastify({
              text: response.message,
              duration: 5000,
              gravity: 'top',
              close: true,
              style: {
                background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)', 
              }
            }).showToast();
  
            // Determine the redirect URL based on the role
            switch (role) {
              case "super admin":
                redirectUrl = "superAdmin.php"; 
                break;
              case "admin":
                /* redirectUrl = "http://localhost/inventoryKeeper/dashboard.php"; */
                redirectUrl = "admin.php"; 
                break;
              case "sales manager":
                redirectUrl = "sales_manager.php";
                break;
              case "store keeper":
               // redirectUrl = "http://localhost/inventoryKeeper/storeKeeper.php";
                redirectUrl = "store_keeper.php";
                break;
              // Add other roles as needed
  
              default:
                // Redirect to a default page if role not recognized
                redirectUrl = "https://igs.ng/pos";
                break;
            }
            
            // Delay the redirect by 3 seconds (3000 milliseconds)
            setTimeout(function() {
              window.location.href = redirectUrl;
            }, 3000);
          } else {
            // Login failed, display error message
           // $("#errorMessage").text("Invalid username or password.");
           // $("#errorMessage").show();

           Toastify({
            text: 'Invalid username or password!',
            duration: 5000,
            gravity: 'top',
            close: true,
            style: {
              background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
            }
          }).showToast();
          }
        },
        complete: function() {
          // hide loading spinner or loading message if desired
          loader.hide();
          $("#errorMessage").fadeOut(6000);
        },
        error: function(xhr, status, error) {
          console.log(error);
          // Handle error if needed
        }
      });
    });
  });
  