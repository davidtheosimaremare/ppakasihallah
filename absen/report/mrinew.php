<?php
$place='../';
include $place.'header.php';
include $place.'db.php';
if($_POST['download']=='Download'){
 $no = $_POST['no'];
 $tahun = $_POST['tahun'];
 $bulan = $_POST['bulan'];
 
header("Location: https://ppasihingbapa.com/excel/PHPExcel-1.8/Examples/download_allabsen.php?no=$no&tahun=$tahun&bulan=$bulan");
}


?>
<html>
<head></head>
<body>
<form method="POST">
<select name="no">
	<option value="5">Kelompok Usia 3-5 Tahun</option>
	<option value="1">Kelompok Usia 6-8 Tahun</option>
	<option value="2">Kelompok Usia 9-11 Tahun</option>
	<option value="3">Kelompok Usia 12-14 Tahun</option>
	<option value="4">Kelompok Usia 15-18 Tahun</option>
	<option value="6">Kelompok Usia 19-20 Tahun</option>
</select>

<select name="tahun">
	<option value="2014">2014</option>
	<option value="2015">2015</option>
	<option value="2016">2016</option>
	<option value="2017">2017</option>
	<option value="2018">2018</option>
	<option value="2019">2019</option>
	<option value="2020">2020</option>
	<option value="2021">2021</option>
	<option value="2022">2022</option>
	<option value="2023">2023</option>
	<option value="2024">2024</option>
	<option value="2025">2025</option>
</select>
<select name="bulan">
	<option value="1">Januari</option>
	<option value="2">Februari</option>
	<option value="3">Maret</option>
	<option value="4">April</option>
	<option value="5">Mei</option>
	<option value="6">Juni</option>
	<option value="7">Juli</option>
	<option value="8">Agustus</option>
	<option value="9">September</option>
	<option value="10">Oktober</option>
	<option value="11">November</option>
	<option value="12">Desember</option>

</select>
<input type="submit" name="download" value="Download" />

</form>
</body>
</html>