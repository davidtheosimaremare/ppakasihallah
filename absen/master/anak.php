<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$place='../';

require $place.'header.php';
require $place.'db.php';

$result = mysqli_query($con,"SELECT * FROM anak_ppa") or die(mysqli_error());

echo "<table border=1><tr><td align='center' colspan=17><a href='insert_anak.php?no=0&&page=12' ><img border='0' width='25' height='25' src='".$place."img/add.png'/></a></td></tr>";
echo "<tr align='center'>";
echo "<td  rowspan=2>NO ANAK</td>";
echo "<td  rowspan=2>NAMA ANAK</td>";
echo "<td  rowspan=2>PANGGILAN</td>";
echo "<td  rowspan=2>L/P</td>";
echo "<td  rowspan=2>TGL LAHIR</td>";
echo "<td  rowspan=2>AGAMA</td>";
echo "<td colspan=3>AYAH</td>";
echo "<td colspan=3>IBU</td>";
echo "<td rowspan=2>JMLH TANGGUNGAN</td>";
echo "<td  rowspan=2>JMLH L/P DI BWH 18 THN</td>";
echo "<td  rowspan=2>JARAK RMH ANAK KE PPA</td>";
echo "<td  rowspan=2>ALAMAT RUMAH ANAK</td>";
echo "<td  rowspan=2>KETERANGAN</td>";

echo "</tr>";
echo "<tr><td>NAMA</td><td>PEKERJAAN</td><td>PENGHASILAN</td><td>NAMA</td><td>PEKERJAAN</td><td>PENGHASILAN</td></tr>";

while($row = mysqli_fetch_array($result))
{
  if ($row[1]!='')
  {
    $ttl=strtotime($row[4]);
    if ($ttl !== false) {
      $tanggal=date('d M Y',$ttl);
    } else {
      $tanggal='';
    }
  }
  else {
    $tanggal='';
  }

  echo "<tr>";
  echo "<td><a href='insert_anak.php?page=12&&no=".substr($row[0],8,3)."'>".$row[0] ."</a></td>";
  echo "<td>".$row[1] ."</td>";  
  echo "<td>".$row[2] ."</td>";  
  echo "<td>".$row[3] ."</td>";  
  echo "<td>".$tanggal."</td>";  
  echo "<td>".$row[5] ."</td>";  
  echo "<td>".$row[6] ."</td>";  
  echo "<td>".$row[7] ."</td>";
  echo "<td>".$row[8] ."</td>";  
  echo "<td>".$row[9] ."</td>";
  echo "<td>".$row[10] ."</td>";  
  echo "<td>".$row[11] ."</td>";
  echo "<td>".$row[12] ."</td>";  
  echo "<td>".$row[13] ."</td>";
  echo "<td>".$row[14] ."</td>";  
  echo "<td>".$row[15] ."</td>";
  echo "<td>".$row[16] ."</td>";	
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
