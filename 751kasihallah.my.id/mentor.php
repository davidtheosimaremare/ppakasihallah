<?php 
$place='../';
$ttl='';
include $place.'header.php';
include '../db.php';
$result = mysqli_query($con,"SELECT * FROM mentor") or die(mysqli_error());
echo "<table border=1>";
echo "<tr align='center'><td align='center' colspan='5'><a href='insert_mentor.php?no=0&&page=11' ><img border='0' width='25' height='25' src='".$place."img/add.png'/></a></td></tr>";
echo "<tr align='center'>";
echo "<td>NO</td>";
echo "<td>NAMA MENTOR</td>";
echo "<td>PANGGILAN</td>";
echo "</tr>";
$i=1;
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>".$i."</td>";
  echo "<td><a href='insert_mentor.php?page=11&&no=".$row['id_mentor']."'>".$row['nama_mentor']."</td>";
  echo "<td>".$row['nama_panggilan']."</td>";
  echo "</tr>";
   $i=$i+1;
  }

mysqli_close($con);

?>



<?php
include $place.'footer.php';
?>