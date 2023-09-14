$(document).ready(function() {
// Function to fetch total users
function countAllUsers() {
  $.ajax({
      url: 'countAllUsers.php', 
      type: 'GET',
      dataType: 'json',
      success: function(response) {
          // Handle the response here
     
          $('.totalUsers').text(response.total_users)
        //console.log(response.total_sales);
          // You can process the response data for charts or other purposes
      },
      error: function(xhr, status, error) {
          // Handle error response
          console.log(error);
      }
  });
}
//call function
setInterval(countAllUsers, 2000);

  // Function to fetch transactions with pagination
  function fetchTransactions(page) {

    var transactionType = $('#transactionType').val();  
    var transactionUser = $('#transactionUser').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();

    $.ajax({ 
      url: 'transactions_users.php', 
      type: 'GET',
      dataType: 'json',
      data: {
        page: page,
        transactionType: transactionType,
        transactionUser: transactionUser, 
        startDate: startDate,
        endDate: endDate
      },
      success: function(response) {
        // Clear the table body
        $('#transactionTableBody').empty();

        // Populate the table with transactions
        $.each(response.transactions, function(index, transaction) {
          var row = '<tr>';
          row += '<td>' + transaction.transaction_id + '</td>';
          row += '<td>' + transaction.username + '</td>';
          row += '<td>' + transaction.item_name + '</td>';
          row += '<td>' + transaction.transaction_date + '</td>';
          row += '<td>' + transaction.transaction_type + '</td>';
          row += '<td>' + transaction.quantity + '</td>';
          row += '<td>' + transaction.total_amount + '</td>';
          row += '<td>' + transaction.purchase_price + '</td>';
          row += '<td>' + transaction.profit_loss + '</td>';
          row += '</tr>';
          $('#transactionTableBody').append(row); 
        });

        // Update the pagination links
        updatePagination(response.total_pages, page);
      },
      error: function(xhr, status, error) {
        // Handle error response
        console.log(error);
      }
    });
  }

    // Event handler for filter fields
    $('#transactionType, #transactionUser, #startDate, #endDate').change(function() {
      // Fetch transactions for the initial page
      fetchTransactions(1);
    });

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
      fetchTransactions(page);
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
      fetchTransactions(page);
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
      fetchTransactions(1);
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
      fetchTransactions(page);
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
      fetchTransactions(totalPages);
    });
    var lastPageListItem = $('<li>').addClass('page-item').append(lastPageLink);
    paginationList.append(lastPageListItem);
  }

  paginationList.prepend(previousListItem);
  paginationList.append(nextListItem);
  paginationContainer.append(paginationList);
}


  // Fetch transactions for the initial page
  fetchTransactions(1);
});
