<?php
// Load library PHPExcel
require_once 'Classes/PHPExcel.php';

// Create object PHPExcel
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Your Name")->setLastModifiedBy("Your Name")
                            ->setTitle("Title of Excel File")
                             ->setSubject("Subject of Excel File")
                             ->setDescription("Description of Excel File")
                             ->setKeywords("excel php")
                             ->setCategory("Category");

// Create first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');

// Add data to first sheet
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Name')
                              ->setCellValue('B1', 'Age')
                              ->setCellValue('C1', 'City')
                              ->setCellValue('A2', 'John Doe')
                              ->setCellValue('B2', 30)
                              ->setCellValue('C2', 'New York')
                              ->setCellValue('A3', 'Jane Smith')
                              ->setCellValue('B3', 25)
                              ->setCellValue('C3', 'Los Angeles');

// Set column width on first sheet
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);

// Create second sheet
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('Sheet2');

// Add data to second sheet
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Product')
                              ->setCellValue('B1', 'Quantity')
                              ->setCellValue('C1', 'Price')
                              ->setCellValue('A2', 'Item A')
                              ->setCellValue('B2', 10)
                              ->setCellValue('C2', 100)
                              ->setCellValue('A3', 'Item B')
                              ->setCellValue('B3', 5)
                              ->setCellValue('C3', 50);

// Set column width on second sheet
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);

// Set active sheet index to the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel file to server
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('example.xlsx');

echo "File created successfully";
?>
