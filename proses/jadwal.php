<?php 
$place='../';
$ttl='';
include $place.'header.php';
include $place.'db.php';
$result = mysqli_query($con,"SELECT * FROM jadwal_kelas a LEFT JOIN kelas b ON a.kelas_id=b.id_kelas LEFT JOIN mentor c ON a.mentor_id=c.id_mentor LEFT JOIN kelompok_usia d ON b.kelompok_id=d.id_kelompok LEFT JOIN jadwal_kegiatan e ON b.jadwal_id=e.id_jadwal ORDER BY id_jkelas DESC") or die(mysqli_error());
echo "<table border=1>";
echo "<tr align='center'><td align='center' colspan='6'><a href='insert_jadwal.php?no=0&&page=21&&generate=n' ><img border='0' width='25' height='25' src='".$place."img/add.png'/></a></td></tr>";
echo "<tr align='center'>";
echo "<td>NO</td>";
echo "<td>NO KELAS</td>";
echo "<td>BULAN/TAHUN</td>";
echo "<td>MENTOR</td>";
echo "<td>KELOMPOK USIA</td>";
echo "<td>JADWAL KEGIATAN</td>";

echo "</tr>";
$i=1;
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='insert_jadwal.php?page=21&&generate=n&&no=".$row['id_jkelas']."'>".$i."</a></td>";
  echo "<td>".$row['id_kelas']."</td>";
  echo "<td>".date('F Y',mktime(0,0,0,$row['bulan'],1,$row['tahun']))."</td>";
  echo "<td>".$row['nama_mentor']."</td>";
  echo "<td>".$row['nama_kelompok']."</td>";
  echo "<td>".$row['daftar_jadwal']."</td>";
  echo "</tr>";
   $i=$i+1;
  }

mysqli_close($con);

?>



<?php
include $place.'footer.php';
?>