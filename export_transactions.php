<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Include the database connection
include('connection.php');

// Get the selected transaction IDs from the POST request
$transactionIds = isset($_POST['transactionIds']) ? $_POST['transactionIds'] : [];

// Fetch the selected transactions from the database
$query = "SELECT t.transaction_id, t.transaction_date, t.profit_loss, t.item_id, i.item_name, i.item_description, i.purchase_price, i.sale_price, i.quantity_in_stock, t.transaction_type, t.quantity, t.total_amount
          FROM transactions t
          JOIN items i ON t.item_id = i.item_id
          WHERE t.transaction_id IN (".implode(',', $transactionIds).")";

$result = $conn->query($query);

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the column headers
$sheet->setCellValue('A1', 'Transaction ID');
$sheet->setCellValue('B1', 'Transaction Date');
$sheet->setCellValue('C1', 'Profit/Loss');
$sheet->setCellValue('D1', 'Item ID');
$sheet->setCellValue('E1', 'Item Name');
$sheet->setCellValue('F1', 'Item Description');
$sheet->setCellValue('G1', 'Purchase Price');
$sheet->setCellValue('H1', 'Sale Price');
$sheet->setCellValue('I1', 'Quantity in Stock');
$sheet->setCellValue('J1', 'Transaction Type');
$sheet->setCellValue('K1', 'Quantity');
$sheet->setCellValue('L1', 'Total Amount');

// Populate the rows with transaction data
$row = 2;
while ($row_data = $result->fetch_assoc()) {
  $sheet->setCellValue('A'.$row, $row_data['transaction_id']);
  $sheet->setCellValue('B'.$row, $row_data['transaction_date']);
  $sheet->setCellValue('C'.$row, $row_data['profit_loss']);
  $sheet->setCellValue('D'.$row, $row_data['item_id']);
  $sheet->setCellValue('E'.$row, $row_data['item_name']);
  $sheet->setCellValue('F'.$row, $row_data['item_description']);
  $sheet->setCellValue('G'.$row, $row_data['purchase_price']);
  $sheet->setCellValue('H'.$row, $row_data['sale_price']);
  $sheet->setCellValue('I'.$row, $row_data['quantity_in_stock']);
  $sheet->setCellValue('J'.$row, $row_data['transaction_type']);
  $sheet->setCellValue('K'.$row, $row_data['quantity']);
  $sheet->setCellValue('L'.$row, $row_data['total_amount']);
  $row++;
}

// Create a new instance of the Xlsx Writer
$writer = new Xlsx($spreadsheet);

// Set the appropriate headers to force the browser to download the file
header('Content-Type: application/json');
header('Cache-Control: max-age=0');

// Save the spreadsheet to a file
$filePath = 'excelFiles/transactions.xlsx';
$writer->save($filePath);

// Create the JSON response with the file URL
$response = array(
  'fileUrl' => $filePath
);

// Send the JSON response
echo json_encode($response);

// Close the database connection
$conn->close();
?>
