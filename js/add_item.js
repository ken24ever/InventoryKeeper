$(document).ready(function() {
  
    // Function to fetch and display the items
    function viewItems(page) {
      $.ajax({
        url: 'view_items.php',
        type: 'GET',
        dataType: 'json',
        data: {
          page: page,
       
        },
        success: function(response) {
          // Clear the table body
          $('#itemsTableBody').empty();
  
          // Loop through the items data and add each item to the table
          $.each(response.items, function(index, item) {
            var row = '<tr>';
            row += '<td>' + item.item_id + '</td>';
            row += '<td>' + item.item_unique_no + '</td>';
            row += '<td>' + item.item_name + '</td>';
            row += '<td>' + item.item_description + '</td>';
            row += '<td>' + item.purchase_price + '</td>';
            row += '<td>' + item.sale_price + '</td>';
            row += '<td>' + item.status + '</td>';
            row += '<td>' + item.category + '</td>';
            row += '<td>' + item.quantity_in_stock + '</td>';
            row += '<td>';
            row += '<button class="btn btn-primary btn-sm mr-2 edit-item" data-item-id="' + item.item_id + '">Edit</button>';
            row += '<button class="btn btn-danger btn-sm delete-item" data-item-id="' + item.item_id + '">Delete</button>';
            row += '</td>';
            row += '</tr>';
  
            $('#itemsTableBody').append(row); 
            console.log(item.item_unique_no)
          });

          
            // Update the pagination links
        updatePagination(response.total_pages, page);

        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    }

     // Function to update pagination links
function updatePagination(totalPages, currentPage) {
  var paginationContainer = $('#paginationContainer');
  paginationContainer.empty();

  // Define the maximum number of visible page links
  var maxVisiblePages = 3; // Adjust this value as needed

  // Create previous button
  var previousButton = $('<a>').attr('href', '#').addClass('page-link').text('Previous');
  if (currentPage === 1) {
    previousButton.addClass('disabled');
    previousButton.addClass('text-danger');
  } else {
    previousButton.click(function(e) {
      e.preventDefault();
      var page = currentPage - 1;
      viewItems(page);
    });
  }

  // Create next button
  var nextButton = $('<a>').attr('href', '#').addClass('page-link').text('Next');
  if (currentPage === totalPages) {
    nextButton.addClass('disabled');
    nextButton.addClass('text-danger');
  } else {
    nextButton.click(function(e) {
      e.preventDefault();
      var page = currentPage + 1;
      viewItems(page);
    });
  }

  // Create pagination container
  var paginationList = $('<ul>').addClass('pagination justify-content-center');
  var previousListItem = $('<li>').addClass('page-item').append(previousButton);
  var nextListItem = $('<li>').addClass('page-item').append(nextButton);

  // Calculate the range of visible page links
  var startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
  var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

  // Add ellipsis before the first page if needed
  if (startPage > 1) {
    var firstPageLink = $('<a>').attr('href', '#').addClass('page-link').text('1');
    firstPageLink.click(function(e) {
      e.preventDefault();
      viewItems(1);
    });
    var firstPageListItem = $('<li>').addClass('page-item').append(firstPageLink);
    paginationList.append(firstPageListItem);
    if (startPage > 2) {
      paginationList.append($('<li>').addClass('page-item').append($('<span>').addClass('page-link').text('...')));
    }
  }

  // Create page links
  for (var i = startPage; i <= endPage; i++) {
    var link = $('<a>').attr('href', '#').addClass('page-link').text(i);
    if (i === currentPage) {
      link.addClass('active');
    }

    // Bind click event to fetch transactions for the clicked page
    link.click(function(e) {
      e.preventDefault();
      var page = parseInt($(this).text());
      viewItems(page);
    });

    var listItem = $('<li>').addClass('page-item').append(link);
    paginationList.append(listItem);
  }

  // Add ellipsis after the last page if needed
  if (endPage < totalPages) {
    if (endPage < totalPages - 1) {
      paginationList.append($('<li>').addClass('page-item').append($('<span>').addClass('page-link').text('...')));
    }
    var lastPageLink = $('<a>').attr('href', '#').addClass('page-link').text(totalPages);
    lastPageLink.click(function(e) {
      e.preventDefault();
      viewItems(totalPages);

    });
    var lastPageListItem = $('<li>').addClass('page-item').append(lastPageLink);
    paginationList.append(lastPageListItem);
  }

  paginationList.prepend(previousListItem);
  paginationList.append(nextListItem);
  paginationContainer.append(paginationList);
}


  
    // Call the viewItems function to display the items on page load
    viewItems(1);

    
     
    // Handle form submission on clicking 'Add Item' button
    $('#addItemForm').submit(function(event) {
      event.preventDefault(); // Prevent default form submission
  
      // Validate the form fields
      var itemName = $('#itemName').val();
      var itemDescription = $('#itemDescription').val();
      var itemPrice = $('#itemPrice').val();
      var salePrice = $('#salePrice').val();
      var itemQuantity = $('#itemQuantity').val();
      var itemUniqueNo = $('#itemUniqueNo').val();
      var categorySelect = $('#categorySelect').val();
      if (!itemName || !itemPrice || !itemQuantity || !itemUniqueNo || !salePrice || !categorySelect) {
       // alert('Please fill all required fields.');
        Toastify({
          text: 'Please fill all required fields.',
          duration: 5000,
          gravity: 'top',
          close: true,
          style: {
            background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
          }
        }).showToast();
        return;
      }
    console.log(itemUniqueNo)
      // Sanitize input data (optional, can be done server-side as well)
      itemName = escapeHtml(itemName);
      itemDescription = escapeHtml(itemDescription);
      itemPrice = parseFloat(itemPrice).toFixed(2);
      itemQuantity = parseInt(itemQuantity);
  
      // Send the data to the PHP script for insertion
      $.ajax({
        url: 'add_item.php', 
        type: 'POST',
        dataType: 'json',
        data: {
          itemName: itemName,
          itemDescription: itemDescription,
          itemPrice: itemPrice,
          itemQuantity: itemQuantity,
          itemUniqueNo: itemUniqueNo,
          salePrice:salePrice,
          categorySelect:categorySelect
        },
        success: function(response) {
          // Handle the response from the server (if needed)
         // alert('Item added successfully!');

          Toastify({
            text: 'Item added successfully!',
            duration: 5000,
            gravity: 'top',
            close: true,
            style: {
              background: 'linear-gradient(to right, #FFA0A0, #B88AFF, #A0A0FF)',
            }
          }).showToast();
          
           // Call the viewItems function to display the items on page load
      viewItems(1);

          // Clear the form after successful submission
          $('#addItemForm')[0].reset();
        },
        error: function(xhr, status, error) {
          // Handle error response
          alert('Error: ' + error);
        }
      });
    });
  });
  
  // Helper function to escape HTML characters
  function escapeHtml(str) {
    return str.replace(/[&<>"'\/]/g, function (s) {
      return {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
        '/': '&#47;'
      }[s];
    });
  }
  