<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2012 PHPExcel
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
 * @copyright  Copyright (c) 2006 - 2012 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.8, 2012-10-12
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
require '../db.php';
$result = mysql_query("SELECT * FROM jadwal_kelas a LEFT JOIN kelas b ON a.kelas_id=b.id_kelas LEFT JOIN mentor c ON a.mentor_id=c.id_mentor LEFT JOIN kelompok_usia d ON b.kelompok_id=d.id_kelompok LEFT JOIN jadwal_kegiatan e ON b.jadwal_id=e.id_jadwal WHERE id_jkelas=".$_GET['no'],$con) or die(mysql_error());
$tgl='';
if($row = mysql_fetch_array($result))
	{	
	$no=$_GET['no'];
	$kelas=$row['kelas_id'];
	$bulan=$row['bulan'];
	$tahun=$row['tahun'];
	$mentor=$row['nama_mentor'];
	$panggilan=$row['nama_panggilan'];
	$usia=$row['nama_kelompok'];
	$jadwal=$row['daftar_jadwal'];
	$date=date('F Y',mktime(0,0,0,$bulan,1,$tahun));
	$tgl=date('Y-m-d',mktime(0,0,0,$bulan+1,-1,$tahun));
	}
$resultdate = mysql_query("SELECT DAYOFMONTH(tanggal) as a FROM kelas_aktif WHERE jkelas_id=".$_GET['no']." AND aktif='y'",$con) or die(mysql_error());
$tanggal=array();
$tanggal[5]=0;
$tanggal[6]=0;
$tanggal[7]=0;
$tanggal[8]=0;
$tanggal[9]=0;
$i=0;
while($row = mysql_fetch_array($resultdate))
	{	
	$tanggal[$i]=$row['a'];
	$i=$i+1;
	}
if($i==9)
	$tanggal[9]='';
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


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ABSENSI KEHADIRAN '.strtoupper($date))
		->setCellValue('A2', 'MENTOR')
		->setCellValue('A3', 'PANGGILAN')
		->setCellValue('A4', 'USIA')
		->setCellValue('C2', ': '.$mentor)
		->setCellValue('C3', ': '.$panggilan)
		->setCellValue('C4', ': '.$usia);
		
$objPHPExcel->getActiveSheet()
		->setCellValue('A6', 'NO.')
		->setCellValue('B6', 'NO-IO')
		->setCellValue('C6', 'NAMA DAN PANGGILAN')
		->setCellValue('E6', 'L/P')
		->setCellValue('F6', 'UMUR')
		->setCellValue('G6', 'HAPUS')
		->setCellValue('H6', $tanggal[0])
		->setCellValue('I6', $tanggal[1])
		->setCellValue('J6', $tanggal[2])
		->setCellValue('K6', $tanggal[3])
		->setCellValue('L6', $tanggal[4])
		->setCellValue('M6', $tanggal[5])
		->setCellValue('N6', $tanggal[6])
		->setCellValue('O6', $tanggal[7])
		->setCellValue('P6', $tanggal[8])
		->setCellValue('Q6', $tanggal[9])
		->setCellValue('R6', 'JML HADIR')
		->setCellValue('S6', 'JML KEGIATAN')
		->setCellValue('T6', 'PERSEN HADIR')
		->setCellValue('U6', 'KETERANGAN');
$sql="SELECT DATEDIFF('".$tgl."' ,  `tgl_lahir` ) / 365.25 AS age,id_anak,nama_anak,nama_panggilan,jenis_kelamin,id_kanak FROM kelas_anak a LEFT JOIN anak_ppa b ON a.anak_id = b.id_anak
WHERE jkelas_id =".$_GET['no']." ORDER BY anak_id";
$result=mysql_query($sql,$con) or die(mysql_error());
$a=7;
$b=1;
while($row = mysql_fetch_array($result))
	{
$sql="SELECT *,ket_desk FROM `absen_anak` left join keterangan on `absen_anak`.ket=keterangan.ket_id WHERE kanak_id=".$row['id_kanak'];
	$result2=mysql_query($sql,$con) or die(mysql_error());
	$abs="";
	$i=0;
$tanggal=array();
$tanggal[5]=0;
$tanggal[6]=0;
$tanggal[7]=0;
$tanggal[8]=0;
$tanggal[9]=0;
$i=0;
$masuk=0;

while($row2 = mysql_fetch_array($result2))
	{
	echo $row['id_anak'];	
	$tanggal[$i]=$row2['absen'];
	if($tanggal[$i]=='1')
	$masuk=$masuk+1;
	$i=$i+1;
	$ket=$row2['ket_desk'];
	}


if($i==9)
	$tanggal[9]='';
$persen=($masuk*100)/$i;
$persen=substr($persen,0,4);
$objPHPExcel->getActiveSheet()
		->setCellValue('A'.$a, $b)
		->setCellValue('B'.$a, $row['id_anak'])
		->setCellValue('C'.$a, $row['nama_anak'])
		->setCellValue('D'.$a, $row['nama_panggilan'])
		->setCellValue('E'.$a, $row['jenis_kelamin'])
		->setCellValue('F'.$a, $row['age'])
		->setCellValue('G'.$a, '')
		->setCellValue('H'.$a, $tanggal[0])
		->setCellValue('I'.$a, $tanggal[1])
		->setCellValue('J'.$a, $tanggal[2])
		->setCellValue('K'.$a, $tanggal[3])
		->setCellValue('L'.$a, $tanggal[4])
		->setCellValue('M'.$a, $tanggal[5])
		->setCellValue('N'.$a, $tanggal[6])
		->setCellValue('O'.$a, $tanggal[7])
		->setCellValue('P'.$a, $tanggal[8])
		->setCellValue('Q'.$a, $tanggal[9])
		->setCellValue('R'.$a, $masuk)
		->setCellValue('S'.$a, $i)
		->setCellValue('T'.$a, $persen.'%')
		->setCellValue('U'.$a, $ket);
$a=$a+1;$b=$b+1;
	}


$objPHPExcel->getActiveSheet()
		->mergeCells('A1:T1')
		->mergeCells('A2:B2')
		->mergeCells('A3:B3')
		->mergeCells('A4:B4')
		->mergeCells('C6:D6');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(25);
$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A6:T30')->applyFromArray($styleArray);
unset($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A6:Z6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('H7:T30')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A6:Z6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E6:F6')->getAlignment()->setTextRotation(90);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A6:S100')->getFont()->setName('Book Antiqua')->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Book Antiqua')->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A2:D4')->getFont()->setName('Book Antiqua')->setSize(12);

$objPHPExcel->getActiveSheet()->getStyle('A6:T6')->getAlignment()->setWrapText(true);
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('absensi-wajib');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

$nama=$mentor.$date.".xlsx";
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$nama);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
