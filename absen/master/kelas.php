<?php 
$place='../';
$ttl='';
include $place.'header.php';
require '../../db.php';
$result = mysql_query("SELECT * FROM kelas a LEFT JOIN kelompok_usia b ON a.kelompok_id=b.id_kelompok LEFT JOIN jadwal_kegiatan c ON a.jadwal_id=c.id_jadwal",$con) or die(mysql_error());
echo "<table border=1>";
echo "<tr align='center'><td align='center' colspan='5'><a href='insert_kelas.php?no=0&&page=13' ><img border='0' width='25' height='25' src='".$place."img/add.png'/></a></td></tr>";
echo "<tr align='center'>";
echo "<td>NO KELAS</td>";
echo "<td>KELOMPOK USIA</td>";
echo "<td>JADWAL KEGIATAN</td>";
echo "</tr>";
$i=1;
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='insert_kelas.php?page=13&&no=".$row['id_kelas']."'>".$i."</td>";
  echo "<td>".$row['nama_kelompok']."</td>";
  echo "<td>".$row['daftar_jadwal']."</td>";
  echo "</tr>";
   $i=$i+1;
  }

mysql_close($con);

?>



<?php
include $place.'footer.php';
?>