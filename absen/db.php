<?php

// Pengaturan koneksi database
$servername = "localhost";
$username = "tegartra_ppasihingbapa";
$password = "sihingbapa123";


// Membuat koneksi dengan MySQL
$con = mysqli_connect($servername, $username, $password);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

// Memilih database
$db_selected = mysql_select_db("tegartra_ppasihingbapa", $con);
if (!$db_selected) {
  die ('Can\'t use tegartra_ppasihingbapa database: ' . mysql_error());
}

// Kode Anda dapat melanjutkan dari sini dengan menggunakan koneksi $con yang sudah dibuat



?>
