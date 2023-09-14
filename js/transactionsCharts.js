$(document).ready(function() {

// Function to fetch transaction data for charts
function fetchAll() {
  $.ajax({
      url: 'getAllTransactions.php', 
      type: 'GET',
      dataType: 'json',
      success: function(response) {
          // Handle the response here
          $('.AllSales').text('₦'+response.total_sales)
          $('.monthlySales').text('₦'+response.current_month_total_sales)
          $('.todaySales').text('₦'+response.current_day_total_sales)
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
fetchAll(); 

    // Function to fetch transaction data for charts
    function fetchTransactionData() {
        var category = $('#category').val();
        var start_Date = $('#start_Date').val();
        var end_Date = $('#end_Date').val();

        $.ajax({
            url: 'transaction_data.php', 
            type: 'GET',
            dataType: 'json',
            data: {
              category: category,
              start_Date: start_Date, 
              end_Date: end_Date
            },
            success: function(response) {
              // Call the function to generate the charts
              generateCharts(response);
            },
            error: function(xhr, status, error) {
              // Handle error response
              console.log(error);
            }
          });
          
    }

    $('#category, #start_Date, #end_Date').change(function() {
        fetchTransactionData();
      });
    
      // Fetch initial transaction data and generate charts
      fetchTransactionData();
  
    
    // Function to generate charts using Highcharts
    function generateCharts(data) {
      // Extract the data from the response
      var salesData = data.salesData;
      var inventoryData = data.inventoryData;
  
      // Generate the sales chart
      Highcharts.chart('salesChart', {
        chart: {
          type: 'column'
        },
        title: {
          text: 'Sales Performance'
        },
        xAxis: {
          categories: salesData.categories
        },
        yAxis: {
          title: {
            text: 'Total Sales'
          }
        },
        series: [{
          name: 'Sales',
          data: salesData.sales
        }],
        plotOptions: {
          column: {
            cursor: 'pointer',
            point: {
              events: {
                click: function() {
                  var clickedDate = this.category;
                  openModalForDate(clickedDate);
                }
              }
            }
          }
        }
      });
      
  
      // Generate the inventory chart
      
      Highcharts.chart('inventoryChart', {
        chart: {
          type: 'line'
        },
        title: {
          text: 'Inventory Levels'
        },
        xAxis: {
          categories: inventoryData.categories
        },
        yAxis: {
          title: {
            text: 'Inventory Quantity'
          }
        },
        series: [{
          name: 'Quantity',
          data: inventoryData.quantity
        }],
        plotOptions: {
          line: {
            cursor: 'pointer',
            point: {
              events: {
                click: function() {
                  var clickedDate = this.category;
                  openModalForDate(clickedDate);
                }
              }
            }
          }
        }
      });
      


    }// end of generateCharts(data)
    
    var currentPage = 1; // Variable to track the current page
    var currentDate; // Variable to store the current date
    
    // Function to open the modal for a specific date
    function openModalForDate(date) {
      // Reset the current page to 1
      currentPage = 1;
      currentDate = date;
    
      // Fetch transactions for the selected date and page
      fetchTransactionsByDate(date, currentPage);
    }
    
// Function to fetch transactions for a specific date and page
function fetchTransactionsByDate(date, page) {
  // Set the clicked date in the modal
  $('#modalDate').text(date);

  $.ajax({
    url: 'transaction_data_by_date.php', 
    type: 'GET',
    dataType: 'json',
    data: {
      date: date,
      page: page
    },
    success: function(response) {
      // Clear the modal content
      $('#modalContent').empty();

      // Populate the modal with transaction details
      var transactions = response.transactions; 
      if (transactions.length > 0) {
        // Create the filter form
        var filterForm = $('<form>').addClass('form-inline');
        var filterLabel = $('<label>').addClass('mr-2').text('Filter By Dates:');
        var filterSelect = $('<input>').addClass('form-control mr-2').attr('id', 'categoryFilter').attr('type', 'date');;
    
        filterForm.append(filterLabel).append(filterSelect);

        // Add event listener to the filter select
        filterSelect.on('change', function() {
          var category = $(this).val();
          filterTable(category);
          console.log(category)
        });

        // Append the filter form to the modal content
        $('#modalContent').append(filterForm);

        // Create the transaction table
        var table = $('<table>').addClass('table');
        var tableHead = $('<thead>').append('<tr><th></th><th>Transaction ID</th><th>Transaction Dates</th><th>Profit/Loss</th><th>Item ID</th><th>Item Name</th><th>Item Description</th><th>Purchase Price</th><th>Sale Price</th><th>Quantity in Stock</th><th>Transaction Type</th><th>Quantity</th><th>Total Amount</th></tr>');
        var tableBody = $('<tbody>');

      
   //   var dateParts = transaction.transaction_date.split('-'); // Split the date string by hyphen
   //var formattedDate = dateParts.reverse().join('-'); // Reverse the date parts and join with hyphen again

        // Populate the table with transaction data
        for (var i = 0; i < transactions.length; i++) {
          var transaction = transactions[i];
          var row = $('<tr>');
          row.append('<td><input type="checkbox" class="export-checkbox" data-transaction-id="' + transaction.transaction_id + '"></td>');
          row.append('<td>' + transaction.transaction_id + '</td>');
          row.append('<td>' + transaction.transaction_date + '</td>');
          row.append('<td>' + transaction.profit_loss + '</td>');
          row.append('<td>' + transaction.item_id + '</td>');
          row.append('<td>' + transaction.item_name + '</td>');
          row.append('<td>' + transaction.item_description + '</td>');
          row.append('<td>' + transaction.purchase_price + '</td>');
          row.append('<td>' + transaction.sale_price + '</td>');
          row.append('<td>' + transaction.quantity_in_stock + '</td>');
          row.append('<td>' + transaction.transaction_type + '</td>');
          row.append('<td>' + transaction.quantity + '</td>');
          row.append('<td>' + transaction.total_amount + '</td>'); 
          tableBody.append(row);
        }

        table.append(tableHead).append(tableBody);
        $('#modalContent').append(table);

        // Add event listener to the select all checkbox
        var selectAllCheckbox = $('<input>').attr('type', 'checkbox').attr('id', 'selectAllCheckbox');
        var selectAllLabel = $('<label>').text('Select All').attr('for', 'selectAllCheckbox');
        selectAllCheckbox.on('change', function() {
          $('.export-checkbox').prop('checked', $(this).prop('checked'));
        });

        $('#modalContent').prepend(selectAllCheckbox).prepend(selectAllLabel);

        // Add export button
        var exportButton = $('<button>').addClass('btn btn-success').text('Export to Excel');
        $('#exportBut').html(exportButton);
        exportButton.on('click', function() {
          exportSelectedTransactions();
        });

       

        // Update the pagination links
        updateModalPagination(response.total_pages);
      } else {
        $('#modalContent').html('<p>No transactions found for the selected date.</p>');
      }

      // Open the modal
      $('#myModal').modal('show');
    },
    error: function(xhr, status, error) {
      // Handle error response
      console.log(error);
    }
  });
}

// Function to update the modal pagination links
function updateModalPagination(totalPages, currentPage) {
  var paginationContainer = $('#modalPagination');
  paginationContainer.empty();

  // Create previous button
  var previousButton = $('<button>').addClass('btn btn-primary').text('Previous');
  if (currentPage === 1) {
    previousButton.addClass('disabled');
  } else {
    previousButton.click(function() {
      var page = currentPage - 1;
      fetchTransactionsByDate(currentDate, page);
      console.log(currentDate, page);
    });
  }

  // Create next button
  var nextButton = $('<button>').addClass('btn btn-primary').text('Next');
  if (currentPage === totalPages) {
    nextButton.addClass('disabled');
  } else {
    nextButton.click(function() {
      var page = currentPage + 1;
      fetchTransactionsByDate(currentDate, page);
      console.log(currentDate, page);
    });
  }

  // Create pagination container
  var paginationList = $('<ul>').addClass('pagination justify-content-center');

  var maxVisiblePages = 5; // Maximum number of visible page links
  var startPage = 1;
  var endPage = totalPages;

  // Check if the number of pages exceeds the maximum visible pages
  if (totalPages > maxVisiblePages) {
    var middlePage = Math.ceil(maxVisiblePages / 2);
    var leftEllipsis = $('<li>').addClass('page-item disabled').append($('<span>').addClass('page-link').text('...'));
    var rightEllipsis = $('<li>').addClass('page-item disabled').append($('<span>').addClass('page-link').text('...'));

    // Adjust the start and end pages based on the current page position
    if (currentPage <= middlePage) {
      endPage = maxVisiblePages - 2; // Subtract 2 for the left ellipsis and next button
      nextButton.removeClass('disabled');
    } else if (currentPage > totalPages - middlePage) {
      startPage = totalPages - maxVisiblePages + 3; // Add 3 for the right ellipsis, previous button, and next button
      previousButton.removeClass('disabled');
    } else {
      startPage = currentPage - Math.floor(maxVisiblePages / 2) + 2; // Add 2 for the left ellipsis and previous button
      endPage = currentPage + Math.floor(maxVisiblePages / 2) - 2; // Subtract 2 for the right ellipsis and next button
      previousButton.removeClass('disabled');
      nextButton.removeClass('disabled');
    }

    // Add left ellipsis if start page is greater than 1
    if (startPage > 1) {
      paginationList.append(leftEllipsis);
    }

    // Add page links
    for (var i = startPage; i <= endPage; i++) {
      var link = $('<a>').attr('href', '#').addClass('page-link').text(i);
      if (i === currentPage) {
        link.addClass('active');
      }

      // Bind click event to fetch transactions for the clicked page
      link.click(function(e) {
        e.preventDefault();
        var page = parseInt($(this).text());
        fetchTransactionsByDate(currentDate, page);
      });

      var listItem = $('<li>').addClass('page-item').append(link);
      paginationList.append(listItem);
    }

    // Add right ellipsis if end page is less than total pages
    if (endPage < totalPages) {
      paginationList.append(rightEllipsis);
    }
  } else {
    // Add all page links
    for (var i = 1; i <= totalPages; i++) {
      var link = $('<a>').attr('href', '#').addClass('page-link').text(i);
      if (i === currentPage) {
        link.addClass('active');
      }

      // Bind click event to fetch transactions for the clicked page
      link.click(function(e) {
        e.preventDefault();
        var page = parseInt($(this).text());
        fetchTransactionsByDate(currentDate, page);
      });

      var listItem = $('<li>').addClass('page-item').append(link);
      paginationList.append(listItem);
    }
  }

  paginationList.prepend(previousButton);
  paginationList.append(nextButton);
  paginationContainer.append(paginationList);
}


// Function to filter the transaction table based on the selected category
function filterTable(category) {
  var tableRows = $('#modalContent table tbody tr');
  if (category === '') {
    // Show all rows if no category is selected
    tableRows.show();
  } else {
    // Hide rows that don't match the selected category
    tableRows.each(function() {
      var transactionType = $(this).find('td:nth-child(3)').text();
      if (transactionType !== category) {
        $(this).hide();
      } else {
        $(this).show();
      }
    });
  }
}

// Function to export selected transactions to Excel format
function exportSelectedTransactions() {
  var selectedTransactionIds = [];
  $('.export-checkbox:checked').each(function() {
    var transactionId = $(this).data('transaction-id');
    selectedTransactionIds.push(transactionId);
  });

  if (selectedTransactionIds.length > 0) {
    // Fetch the selected transactions from the server
    $.ajax({
      url: 'export_transactions.php',
      type: 'POST',
      dataType: 'json', // Set the expected response dataType to JSON
      data: {
        transactionIds: selectedTransactionIds,
      },
      success: function(response) {
        // Check if the response contains the file URL
        if (response.fileUrl) {
          // Make a separate request to download the file
          downloadFile(response.fileUrl);
        }
      },
      error: function(xhr, status, error) {
        // Handle error response
        console.log(error);
      }
    });
  }
}

// Function to download the file using FileSaver.js
function downloadFile(fileUrl) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', fileUrl, true);
  xhr.responseType = 'blob';

  xhr.onload = function() {
    if (xhr.status === 200) {
      // Create a Blob object from the response
      var blob = new Blob([xhr.response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

      // Save the Blob using FileSaver.js
      saveAs(blob, 'transactions.xlsx');
    }
  };

  xhr.send();
}






  
   
  });
  