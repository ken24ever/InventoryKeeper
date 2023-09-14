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

     // Fetch and populate role options
     function fetchRoles1() {
      $.ajax({
        url: 'fetch_roles.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          // Populate the role select dropdown
      
          var roleSelectName = $('#editRole');
          roleSelectName.empty(); // Clear existing options
          $.each(response, function(index, roleDet) {
            roleSelectName.append('<option value="' + roleDet.role_name + '">' + roleDet.role_name + '</option>');
          });
  
        },
        error: function(xhr, status, error) {
          // Handle error response
          console.log(error);
        }
      });
    }
  
    fetchRoles1()
  
  // Fetch users for the initial page
  fetchUsers(1);
  
          // Edit User
          $(document).on('click', '.editUser', function() { 
            var userId = $(this).data('user-id');
            // Retrieve the user details using AJAX
            $.ajax({
              url: 'super_get_user.php',
              type: 'POST',
              dataType: 'json',
              data: { user_id: userId },
              success: function(response) {
                // Handle success response
                if (response.success) {
                  // Populate the edit user form with the retrieved user data
                  $('#editUserId').val(response.user.user_id);
                  $('#editUsername').val(response.user.username);
                 // $('#editRole').val(response.user.role_id);
        
                  // Show the edit user modal
                  $('#editUserModal').modal('show');
                }
              },
              error: function(xhr, status, error) {
                // Handle error response
                console.log(error);
              }
            });
          });

           // Edit User Form Submission
        $('#updateUserForm').submit(function(event) {
          event.preventDefault(); // Prevent form submission
      
          // Get form data
          var formData = $(this).serialize();
      
          // Send AJAX request to update the user
          $.ajax({
            url: 'super_update_user.php',
            type: 'POST',
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
      
                // Hide the edit user modal
                $('#editUserModal').modal('hide');
      
                // Fetch and display the updated user list
                fetchUsers(1);
              }
            },
            error: function(xhr, status, error) {
              // Handle error response
              console.log(error);
            }/* ,
            complete: function() {
                // Hide the loading spinner and enable the submit button
                $('#loadingSpinner').hide();
              } */
          });
        });


        // Delete User
        $(document).on('click', '.deleteUser', function() {
          var userId = $(this).data('user-id');

                               // Confirm before deleting
    Swal.fire({
      title: 'Are You Sure You Want To Delete User With ID :'+userId+'?',
      html: '<h6 style="color:red">This Action Cannot Be Undone If You Proceed!</h6>',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: 'darkGreen',
      cancelButtonColor: 'darkRed',
      confirmButtonText: 'Yes, Submit!',
      showLoaderOnConfirm: true,
  }).then((result) => {
          if (result.isConfirmed)
             {
                      // Send AJAX request to delete the user
                      $.ajax({
                        url: 'delete_user.php',
                        type: 'POST',
                        dataType: 'json',
                        data: { user_id: userId },
                            // Before sending the AJAX request
                            beforeSend: function() {
                            // Show a loading spinner or disable the submit button to indicate processing
                                $('#loadingSpinner').show();
                          },
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

                            // Fetch and display the updated user list
                            fetchUsers(1);
                          }
                        },
                        error: function(xhr, status, error) {
                          // Handle error response
                          console.log(error);
                        }
                        ,
                      complete: function() {
                      // Hide the loading spinner and enable the submit button
                      $('#loadingSpinner').hide();
                      }
                      });

              }//end of result.isConfirmed
              else
              {
                    // Show display when you click cancel
                    Swal.fire({
                      icon: 'info',
                      html: '<b>You backed out!</b>'
                      });
              }
          });//end of thenables


        });


    }); //end of doc ready