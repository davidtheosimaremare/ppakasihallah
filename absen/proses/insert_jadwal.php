<?php 
$ttl='';
$place="../";
require '../header.php';
$no='';
$kelas='';
$bulan='';
$tahun='';
$mentor='';

require '../db.php';


if(!$_POST&&$_GET){
$_POST['no']=$_GET['no'];
$_POST['simpan']='';
}
else if($_POST&&$_GET){
$_POST['no']=$_GET['no'];
}
if($_POST)
{
if($_POST['simpan']=='Simpan')
	{
	
	$sql="SELECT id_jkelas from jadwal_kelas where id_jkelas=".$_POST['no'];
	
	$result=mysql_query($sql,$con) or die(mysql_error());

	if($row = mysql_fetch_array($result))
		{

		$sql="UPDATE `jadwal_kelas` SET `kelas_id`=".$_POST['kelas'].",`bulan`='".$_POST['bulan']."',`tahun`='".$_POST['tahun']."',`mentor_id`='".$_POST['mentor']."' WHERE id_jkelas=".$_POST['no'];
		
		echo "Jadwal Kelas Telah Terupdate <br/>";
		}
	else
		{
		$id=1;
		$sql="SELECT id_jkelas FROM jadwal_kelas ORDER BY id_jkelas DESC  LIMIT 1";
		$result=mysql_query($sql,$con) or die(mysql_error());
		if($row = mysql_fetch_array($result))
			{
			$id=$row[0]+1;
			}
		$sql="INSERT INTO `jadwal_kelas`(`id_jkelas`, `kelas_id`, `bulan`, `tahun`, `mentor_id`) VALUES (".$id.",".$_POST['kelas'].",'".$_POST['bulan']."','".$_POST['tahun']."','".$_POST['mentor']."')";
		
		echo "Jadwal Kelas Telah Tersimpan  <br/>";
		}
	
	mysql_query($sql,$con) or die(mysql_error());
		$no=$_POST['no'];
		$kelas=$_POST['kelas'];
		$bulan=$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$mentor=$_POST['mentor'];
	}
else
	{
	$sql="SELECT * from jadwal_kelas where id_jkelas=".$_POST['no'];

	$result=mysql_query($sql,$con) or die(mysql_error());
	if($row = mysql_fetch_array($result))
		{	
		$no=$_POST['no'];
		$kelas=$row[1];
		$bulan=$row[2];
		$tahun=$row[3];
		$mentor=$row[4];
		}
	if($_GET['generate']=='y')
		{

		$month=date("n",mktime(0,0,0,date("n")-1,1,date("Y")));
		$year=date("Y",mktime(0,0,0,date("n")-1,1,date("Y")));
		$sql="SELECT * FROM jadwal_kelas where bulan='".$month."' and tahun='".$year."' ORDER BY kelas_id";
		$result=mysql_query($sql,$con) or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			$id=1;
			$sql="SELECT id_jkelas FROM jadwal_kelas ORDER BY id_jkelas DESC  LIMIT 1";
			$result2=mysql_query($sql,$con) or die(mysql_error());
			if($row2 = mysql_fetch_array($result2))
				{
				$id=$row2[0]+1;

				}
			$sql="INSERT INTO `jadwal_kelas`(`id_jkelas`, `kelas_id`, `bulan`, `tahun`, `mentor_id`) VALUES (".$id.",".$row['kelas_id'].",'".date('n')."','".date('Y')."','".$row['mentor_id']."')";
			mysql_query($sql,$con) or die(mysql_error());		
			}
header('Location: jadwal.php?page=21');

		}

	}
}

?>
 

<form method="POST">
<fieldset>
<legend>Jadwal Kelas PPA</legend>
<table><tr><td>
<table>
<tr><td>Kelas <input type="hidden" name="no" value="<?php echo $no;?>" /></td><td>:</td><td>
<select name="kelas">
<?php 
$sql="SELECT * FROM kelas a LEFT JOIN kelompok_usia b ON a.kelompok_id=b.id_kelompok LEFT JOIN jadwal_kegiatan c ON a.jadwal_id=c.id_jadwal";
$result=mysql_query($sql,$con) or die(mysql_error());
while($row = mysql_fetch_array($result))
	{
	 ?><option value ="<?php echo $row[0];?>" <?php if($kelas==$row[0]) echo "selected='selected'";?>><?php echo $row[0].". ".$row[4]." ".$row[6];?></option><?php	
	}

?>

</select></td></tr>
<tr><td>Bulan</td><td>:</td><td>
<select name="bulan">
<?php
$i=1;
while($i<=12)
	{
	?><option value ="<?php echo $i;?>" <?php if($bulan==$i||($bulan==''&&date('n')==$i)) echo "selected='selected'";?> ><?php echo date("F", mktime(0, 0, 0, $i, 1, 2001));?></option><?php	
	$i=$i+1;
	}

?>
</select>
</td><td>Tahun</td><td>:</td><td>
<select name="tahun">
<?php
$now=date('Y');
$i=$now-20;
while($i<=$now+20)
	{
	?><option value ="<?php echo $i;?>" <?php if($tahun==$i||($tahun==''&&$now==$i)) echo "selected='selected'";?> ><?php echo date("Y", mktime(0, 0, 0, 1, 1, $i));?></option><?php	
	$i=$i+1;
	}

?>
</select>
</td></tr>
<tr><td>Mentor </td><td>:</td><td>
<select name="mentor">
<?php 
$sql="SELECT * FROM mentor";
$result=mysql_query($sql,$con) or die(mysql_error());
while($row = mysql_fetch_array($result))
	{
	 ?><option value ="<?php echo $row[0];?>" <?php if($mentor==$row[0]) echo "selected='selected'";?>><?php echo $row[1];?></option><?php	
	}

?>

</select></td></tr>


<tr><td colspan="3" align=center><input type="submit" name="simpan" value="Simpan" />
</td></tr>
</table>
</td><td>
<table><tr><td><center><a href='insert_jadwal.php?no=0&&page=11&&generate=y' ><img border='0' width='100' height='100' src='<?php echo $place?>img/generate.png'/></a></center></td>
</tr>
<tr><td><b>GENERATE BULAN INI</b></td></tr>
</table>


</td></tr>
</table>
</fieldset>
</form>
</body>
</html>