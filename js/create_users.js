
  $(document).ready(function() {
  // Function to fetch users with pagination
  function fetchUsers(page) {
    $.ajax({
      url: 'view_users.php',
      type: 'GET',
      dataType: 'json',
      data: {
        page: page
      },
      success: function(response) {
        // Clear the table body
        $('#userTableBody').empty();
        $('#paginationCont').html(response.pagination)
  
        // Populate the table with user data
        $.each(response.users, function(index, user) {
          var row = '<tr>';
          row += '<td>' + user.user_id + '</td>';
          row += '<td>' + user.username + '</td>';
          row += '<td>' + user.role_name + '</td>';
          row += '<td>';
          row += '<button class="btn btn-info editUser btn-xl " data-user-id = "'+ user.user_id +'">Edit</button>';
          row += '<button class="btn btn-danger deleteUser btn-xl " data-user-id = "'+ user.user_id +'">Delete</button>';
          row += '</td>';
          row += '</tr>';
          $('#userTableBody').append(row);
        });
      },
      error: function(xhr, status, error) {
        // Handle error response
        console.log(error);
      }
    });
  }
  
  // Function to handle pagination link click
  function handlePaginationClick(e) {
    e.preventDefault();
    var page = $(this).data('page');
    fetchUsers(page);
  }
  
  // Bind click event to pagination links
  $(document).on('click', '.pagination-link', handlePaginationClick);
  
  // Fetch users for the initial page
  fetchUsers(1);

    // Function to fetch and populate role options
    function fetchRoles() {
      $.ajax({
        url: 'fetch_roles.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          // Populate the role select dropdown
          var roleSelect = $('#role');
          roleSelect.empty(); // Clear existing options
          $.each(response, function(index, role) {
            roleSelect.append('<option value="' + role.role_id + '">' + role.role_name + '</option>');
          });
        },
        error: function(xhr, status, error) {
          // Handle error response
          console.log(error);
        }
      });
    }

    // Fetch and populate the role options
    fetchRoles();

    // Handle form submission using AJAX
    $('#createUserForm').submit(function(event) {
      event.preventDefault(); // Prevent form submission

      // Get form data
      var formData = $(this).serialize();

      // Send AJAX request
      $.ajax({
        url: 'create_user.php',
        type: 'POST',
        // Before sending the AJAX request
        beforeSend: function() {
          // Show a loading spinner or disable the submit button to indicate processing
          $('#submitBtn').prop('disabled', true);
          $('#loadingSpinner').show();
        },
        dataType: 'json',
        data: formData,
        success: function(response) {
          // Handle success response
          if (response.success) {
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
            // Reset the form
            $('#createUserForm')[0].reset();

            // Fetch and display the updated user data
            fetchUsers(1);
          }
        },
        error: function(xhr, status, error) {
          // Handle error response
          console.log(error);
        },
        complete: function() {
          // Hide the loading spinner and enable the submit button
          $('#loadingSpinner').hide();
          $('#submitBtn').prop('disabled', false);
        }
      });
    });
  });

