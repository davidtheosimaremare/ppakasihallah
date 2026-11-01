<?php

// Pengaturan koneksi database (Mendukung Environment Variables untuk Coolify / Docker)
$servername = getenv('DB_HOST') ?: "localhost";
$username   = getenv('DB_USER') ?: "tegartra_ppasihingbapa";
$password   = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : "sihingbapa123";
$db         = getenv('DB_NAME') ?: "tegartra_ppasihingbapa";
$port       = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 3306;

// Membuat koneksi dengan MySQL
$con = mysqli_connect($servername, $username, $password, $db, $port);
if (!$con) {
  die('Could not connect: ' . mysqli_connect_error());
}

?>
