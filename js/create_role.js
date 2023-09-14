
  $(document).ready(function() {
    // Handle form submission using AJAX
    $('#createRoleForm').submit(function(event) {
      event.preventDefault(); // Prevent form submission

      // Get form data
      var formData = $(this).serialize();

      // Send AJAX request
      $.ajax({
        url: 'create_role.php',
        type: 'POST',
        data: formData,
        dataType: 'json', // Set the expected response data type

        // Before sending the AJAX request
        beforeSend: function() {
          // Show a loading spinner or disable the submit button to indicate processing 
          $('#submitBtn').prop('disabled', true);
          $('#loadingSpinner').show();
        },

        success: function(response) {
          // Handle success response
          // You can display a success message or update the UI

          // Reset the form
          $('#createRoleForm')[0].reset();

          // Display a success message
         // $('#successMessage').text(response.message).show();

         Toastify({
          text: response.message,
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();

          // Hide the loading spinner and enable the submit button
          $('#loadingSpinner').hide();
          $('#submitBtn').prop('disabled', false);
        },

        error: function(xhr, status, error) {
          // Handle error response
          // You can display an error message or handle the error in any other way

          // Display an error message
         // $('#errorMessage').text('An error occurred. Please try again.').show();

          Toastify({
            text: 'An error occurred. Please try again.',
            duration: 5000,
            gravity: 'top',
            close: true,
            style: {
              background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
            }
          }).showToast();
          // Hide the loading spinner and enable the submit button
          $('#loadingSpinner').hide();
          $('#submitBtn').prop('disabled', false);
        }
      });
    });
  });

