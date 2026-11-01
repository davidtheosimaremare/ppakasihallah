<?php 
$ttl='';
$place="../";
require '../header.php';
$no='';
$kelas='';
$bulan='';
$tahun='';
$mentor='';
$usia='';
$jadwal='';

require '../db.php';


if(!$_POST&&$_GET){
$_POST['no']=$_GET['no'];
$_POST['simpan']='';
$_POST['noanak']=$_GET['noanak'];
}
else if($_POST&&$_GET){
$_POST['no']=$_GET['no'];
}
if($_POST)
{
if($_POST['simpan']=='Simpan')
	{
	$id=1;
	$sql="SELECT id_kanak FROM kelas_anak ORDER BY id_kanak DESC  LIMIT 1";
	$result=mysql_query($sql,$con) or die(mysql_error());
	if($row = mysql_fetch_array($result))
		{
		$id=$row[0]+1;
		}
	$sql="INSERT INTO `kelas_anak`(`id_kanak`, `anak_id`, `jkelas_id`) VALUES (".$id.",'IO-794-0".$_POST['noanak']."',".$_POST['no'].")";
	mysql_query($sql,$con);
	echo "Kelas Anak Telah Tersimpan  <br/>";
	}
else if($_GET['cancel']=='y')
	{
	$sql="DELETE FROM kelas_anak WHERE jkelas_id=".$_POST['no']." AND anak_id='".$_POST['noanak']."'";
	mysql_query($sql,$con);
	}
$result = mysql_query("SELECT * FROM jadwal_kelas a LEFT JOIN kelas b ON a.kelas_id=b.id_kelas LEFT JOIN mentor c ON a.mentor_id=c.id_mentor LEFT JOIN kelompok_usia d ON b.kelompok_id=d.id_kelompok LEFT JOIN jadwal_kegiatan e ON b.jadwal_id=e.id_jadwal WHERE id_jkelas=".$_POST['no'],$con) or die(mysql_error());
if($row = mysql_fetch_array($result))
	{	
	$no=$_POST['no'];
	$kelas=$row['kelas_id'];
	$bulan=$row['bulan'];
	$tahun=$row['tahun'];
	$mentor=$row['nama_mentor'];
	$usia=$row['nama_kelompok'];
	$jadwal=$row['daftar_jadwal'];
	}
if($_GET['generate']=='y')
	{
	$sql="SELECT * FROM `kelas_anak` WHERE jkelas_id=(SELECT id_jkelas FROM jadwal_kelas where bulan='".(date('n',mktime(0,0,0,$bulan-1,1,$tahun)))."' AND tahun='".(date('Y',mktime(0,0,0,$bulan-1,1,$tahun)))."' AND kelas_id=".$kelas.") ORDER BY anak_id";
	echo $sql;
	$result=mysql_query($sql,$con) or die(mysql_error());

	while($row = mysql_fetch_array($result))
		{
		
		$id=1;
		$sql2="SELECT id_kanak FROM kelas_anak ORDER BY id_kanak DESC  LIMIT 1";
		$result2=mysql_query($sql2,$con) or die(mysql_error());
		if($row2 = mysql_fetch_array($result2))
			{
			$id=$row2[0]+1;
				}
		$sql3="INSERT INTO `kelas_anak`(`id_kanak`, `anak_id`, `jkelas_id`) VALUES (".$id.",'".$row['anak_id']."',".$no.")";
		mysql_query($sql3,$con) or die(mysql_error());
		echo $id;		
		}
	header("Location: insert_kelasanak.php?noanak=0&&page=22&&generate=n&&cancel=n&&no=".$_POST['no']);

	}

	
}

?>
 


<fieldset>
<legend>Kelas Anak</legend>
<table><tr><td>
<table>
<tr><td>Kelas</td><td>:</td><td>
<?php 
echo $kelas.". ".$usia." ".$jadwal;
?>

</td></tr>
<tr><td>Bulan</td><td>:</td><td>
<?php
echo date('F',mktime(0,0,0,$bulan,1,2000));
?>
</td><td>Tahun</td><td>:</td><td>
<?php
echo $tahun;
?>
</td></tr>
<tr><td>Mentor </td><td>:</td><td>
<?php 
echo $mentor
?>

</td></tr>
<form method="POST">
<input type="hidden" name="no" value="<?php echo $no;?>"  />
<tr><td align="center" colspan="6">IO-794-0 <input type="text" name="noanak" value="" size="3" /><input type="submit" name="simpan" value="Simpan" /></tr>
</form>
<tr><td colspan="6">
<table border=1>
<tr><td>NO ANAK</td><td>NAMA ANAK</td><td>CANCEL</td></tr>
<?php 
$sql="SELECT id_anak,nama_anak FROM kelas_anak a LEFT JOIN anak_ppa b ON a.anak_id=b.id_anak WHERE jkelas_id=".$_POST['no']." ORDER BY anak_id";
$result=mysql_query($sql,$con) or die(mysql_error());
while($row = mysql_fetch_array($result))
	{
	echo "<tr><td>".$row['id_anak']."</td><td>".$row['nama_anak']."</td><td><center><a href='insert_kelasanak.php?no=".$no."&&noanak=".$row['id_anak']."&&page=22&&generate=n&&cancel=y' ><img border='0' width='25' height='25' src='".$place."img/cancel.png'/></a></center></td></tr>";	
	}
?>

</table>

</td></tr>

</table>
</td><td>
<table><tr><td><center><a href='insert_kelasanak.php?noanak=0&&no=<?php echo $no;?>&&page=22&&generate=y&&cancel=n' ><img border='0' width='100' height='100' src='<?php echo $place?>img/generate.png'/></a></center></td>
</tr>
<tr><td><b>GENERATE BULAN INI</b></td></tr>
</table>


</td></tr>
</table>
</fieldset>

</body>
</html>