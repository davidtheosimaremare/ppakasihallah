<?php 
require_once "/home/tegartra/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Membuat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();

// Mendapatkan lembar kerja aktif
$sheet = $spreadsheet->getActiveSheet();

// Menambahkan data ke sel-sel lembar kerja
$sheet->setCellValue('A1', 'Nama');
$sheet->setCellValue('B1', 'Alamat');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('A2', 'John Doe');
$sheet->setCellValue('B2', 'Jl. Setiabudi No. 10');
$sheet->setCellValue('C2', 'johndoe@example.com');

// Membuat objek writer Xlsx
$writer = new Xlsx($spreadsheet);

// Menyimpan lembar kerja ke dalam file Excel baru
$filename = 'example.xlsx';
$writer->save($filename);

// Mendefinisikan header untuk mengunduh file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

// Mengirimkan file Excel ke browser
$writer->save('php://output');

?>