<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../Classes/PHPExcel.php';

$con = mysqli_connect("localhost","tegartra_ppasihingbapa","ppasihingbapa@123");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con, "tegartra_ppasihingbapa");


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



		
$objPHPExcel->getActiveSheet()
		->setCellValue('B6', 'NO.')
		->setCellValue('C6', 'NO-IO')
		->setCellValue('D6', 'NAMA ANAK')
		->setCellValue('E6', 'L/P')
		->setCellValue('F6', '1')
		->setCellValue('G6', '2')
		->setCellValue('H6', '3')
		->setCellValue('I6', '4')
		->setCellValue('J6', '5')
		->setCellValue('K6', '6')
		->setCellValue('L6', '7')
		->setCellValue('M6', '8')
		->setCellValue('N6', '9')
		->setCellValue('O6', '10')
		->setCellValue('P6', '11')
		->setCellValue('Q6', '12')
		->setCellValue('R6', '13')
		->setCellValue('S6', '14')
		->setCellValue('T6', '15')
		->setCellValue('U6', '16')
		->setCellValue('V6', '17')
		->setCellValue('W6', '18')
		->setCellValue('X6', '19')
		->setCellValue('Y6', '20')
		->setCellValue('Z6', '21')
		->setCellValue('AA6', '22')
		->setCellValue('AB6', '23')
		->setCellValue('AC6', '24')
		->setCellValue('AD6', '25')
		->setCellValue('AE6', '26')
		->setCellValue('AF6', '27')
		->setCellValue('AG6', '28')
		->setCellValue('AH6', '29')
		->setCellValue('AI6', '30')
		->setCellValue('AJ6', '31')
		->setCellValue('AK6', 'KETERANGAN');
		$bulan=$_GET['bulan'];
$tahun=$_GET['tahun'];

$tgl=$tgl=date('Y-m-d',mktime(0,0,0,$bulan+1,-1,$tahun));
$sql="SELECT DATEDIFF('".$tgl."' ,  `tgl_lahir` ) / 365.25 AS age,id_anak,nama_anak,nama_panggilan,jenis_kelamin,id_kanak FROM kelas_anak a LEFT JOIN jadwal_kelas c on a.jkelas_id=c.id_jkelas LEFT JOIN kelas d on c.kelas_id=d.id_kelas LEFT JOIN anak_ppa b ON a.anak_id = b.id_anak
WHERE kelompok_id =".$_GET['no']." and bulan=".$bulan." and tahun=".$tahun." ORDER BY anak_id";

$result=mysqli_query($con, $sql) or die(mysqli_error($con));
$a=7;
$b=1;
while($row = mysqli_fetch_array($result))
{
    $masuk=array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","", "", "");
    $angka=array();
    $angka["1"]=1;
    $angka["2"]=2;
    $angka["3"]=3;
    $angka["4"]=4;
    $angka["5"]=5;
    $angka["6"]=6;
    $angka["7"]=7;
    $angka["8"]=8;
    $angka["9"]=9;

    $sql="SELECT a.*,b.ket_desk FROM absen_anak a left join keterangan b on a.ket=b.ket_id where kanak_id=".$row['id_kanak'];
    $result2=mysqli_query($con, $sql) or die(mysqli_error($con));
    $x=1;$ket="";
  
    while($row2 = mysqli_fetch_array($result2))
    {
        $tglmsuk=substr($row2['tanggal'],8);
        if($tglmsuk>=10)    
            $masuk[$tglmsuk]=$row2['absen'];
        else{
            $tglmsuk=substr($tglmsuk,1);
            $masuk[$tglmsuk]=$row2['absen'];
        }
        if($row2['ket']!="")
            $ket=$row2['ket_desk'];
        $x++;
    }

$objPHPExcel->getActiveSheet()
		->setCellValue('B'.$a, $b)
		->setCellValue('C'.$a, $row['id_anak'])
		->setCellValue('D'.$a, $row['nama_anak'])
		->setCellValue('E'.$a, $row['jenis_kelamin'])
		->setCellValue('F'.$a, $masuk[1])
		->setCellValue('G'.$a, $masuk[2])
		->setCellValue('H'.$a, $masuk[3])
		->setCellValue('I'.$a, $masuk[4])
		->setCellValue('J'.$a, $masuk[5])
		->setCellValue('K'.$a, $masuk[6])
		->setCellValue('L'.$a, $masuk[7])
		->setCellValue('M'.$a, $masuk[8])
		->setCellValue('N'.$a, $masuk[9])
		->setCellValue('O'.$a, $masuk[10])
		->setCellValue('P'.$a, $masuk[11])
		->setCellValue('Q'.$a, $masuk[12])
		->setCellValue('R'.$a, $masuk[13])
		->setCellValue('S'.$a, $masuk[14])
		->setCellValue('T'.$a, $masuk[15])
		->setCellValue('U'.$a, $masuk[16])
		->setCellValue('V'.$a, $masuk[17])
		->setCellValue('W'.$a, $masuk[18])
		->setCellValue('X'.$a, $masuk[19])
		->setCellValue('Y'.$a, $masuk[20])
		->setCellValue('Z'.$a, $masuk[21])
		->setCellValue('AA'.$a, $masuk[22])
		->setCellValue('AB'.$a, $masuk[23])
		->setCellValue('AC'.$a, $masuk[24])
		->setCellValue('AD'.$a, $masuk[25])
		->setCellValue('AE'.$a, $masuk[26])
		->setCellValue('AF'.$a, $masuk[27])
		->setCellValue('AG'.$a, $masuk[28])
		->setCellValue('AH'.$a, $masuk[29])
		->setCellValue('AK'.$a, $ket);
	$a++;
	$b++;
	}

 
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('absensi-wajib');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

$nama="absenku.xlsx";

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$nama);
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

