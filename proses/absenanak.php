<?php 

$place='../';
$ttl='';
$bulan='';
$tahun='';
$data="";
include $place.'header.php';

include $place.'db.php';
$i=1;
echo "data";
if($_POST){

$result = mysqli_query($con,"SELECT DISTINCT * FROM jadwal_kelas a LEFT JOIN kelas b ON a.kelas_id=b.id_kelas LEFT JOIN mentor c ON a.mentor_id=c.id_mentor LEFT JOIN kelompok_usia d ON b.kelompok_id=d.id_kelompok LEFT JOIN jadwal_kegiatan e ON b.jadwal_id=e.id_jadwal WHERE bulan='".$_POST['bulan']."' and tahun='".$_POST['tahun']."' ORDER BY kelas_id ASC") or die(mysqli_error());
$bulan=$_POST['bulan'];
while($row = mysqli_fetch_array($result))
  {
  $data=$data."<tr>";
  $data=$data."<td>".$i."</td>";
  $data=$data."<td>".$row['id_kelas']."</td>";
  $data=$data."<td>".date('F Y',mktime(0,0,0,$row['bulan'],1,$row['tahun']))."</td>";
  $data=$data."<td>".$row['nama_mentor']."</td>";
  $data=$data."<td>".$row['nama_kelompok']."</td>";
  $data=$data."<td>".$row['daftar_jadwal']."</td>";
  $sql="SELECT COUNT(id_kanak) FROM kelas_anak WHERE jkelas_id=".$row['id_jkelas'];
  $result2 = mysqli_query($con,$sql);
  if($row2 = mysqli_fetch_array($result2))
  	{

	$data=$data."<td><a href='insert_absenanak.php?nokanak=0&&page=22&&generate=n&&edit=n&&no=".$row['id_jkelas']."'>".$row2[0]."</a></td>";
  	
  	}

  $data=$data."</tr>";
   $i=$i+1;
	
  }

mysqli_close($con);
}
echo "<table border=1>";
?>
<tr><td colspan='7'>
<form method="POST">
<center>Bulan:
<select name="bulan">
<?php
$i=1;
while($i<=12)
	{
	?><option value ="<?php echo $i;?>" <?php if($bulan==$i||(date('n')==$i&&$bulan=='')) echo "selected='selected'";?> ><?php echo date("F", mktime(0, 0, 0, $i+1, 0, 0));?></option><?php	
	$i=$i+1;
	}

?>
</select>
Tahun:
<select name="tahun">
<?php
$now=date('Y');
$i=$now-20;
while($i<=$now+20)
	{
	?><option value ="<?php echo $i;?>" <?php if($tahun==$i||($tahun==''&&$now==$i)) echo "selected='selected'";?> ><?php echo gmdate("Y", mktime(0, 0, 0, 0, 0, $i+1));?></option><?php	
	$i=$i+1;
	}

?>
</select> <input type="submit" name="cari" style="padding-bottom:15px;background: url('<?php echo $place;?>img/search.png');background-size:50px;width:50px;height:50px;"  value="Cari" />
</center>
</form>
</td></tr>
<?php
echo "<tr align='center'>";
echo "<td>NO</td>";
echo "<td>NO KELAS</td>";
echo "<td>BULAN/TAHUN</td>";
echo "<td>MENTOR</td>";
echo "<td>KELOMPOK USIA</td>";
echo "<td>JADWAL KEGIATAN</td>";
echo "<td>JUMLAH ANAK</td>";
echo "</tr>";
echo $data;
?>



<?php
include $place.'footer.php';
?>