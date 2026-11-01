<?php 

$place='../';
$ttl='';
include $place.'header.php';
include '../db.php';
$no='';
$usia='';
$jadwal='';


if(!$_POST&&$_GET){
$_POST['no']=$_GET['no'];
$_POST['simpan']='';
}
else if($_POST&&$_GET){
$_POST['no']=$_GET['no'];
}
if($_POST)
{
require '../db.php';
if($_POST['simpan']=='Simpan')
	{
	
	$sql="SELECT id_kelas from kelas where id_kelas=".$_POST['no'];
	
	$result=mysqli_query($con,$sql) or die(mysql_error());

	if($row = mysqli_fetch_array($result))
		{

		$sql="UPDATE `kelas` SET `jadwal_id`=".$_POST['jadwal'].",`kelompok_id`=".$_POST['usia']." WHERE id_kelas=".$_POST['no'];
		
		echo "Data Kelas Telah Terupdate <br/>";
		}
	else
		{
		$id=1;
		$sql="SELECT id_kelas FROM kelas ORDER BY id_kelas DESC  LIMIT 1";
		$result=mysqli_query($con,$sql) or die(mysqli_error());
		if($row = mysqli_fetch_array($result))
			{
			$id=$row[0]+1;
			}
		$sql="INSERT INTO `kelas` (`id_kelas`, `jadwal_id`,`kelompok_id`) VALUES (".$id.",".$_POST['jadwal'].",".$_POST['usia'].")";
		
		echo "Data Kelas Telah Tersimpan  <br/>";
		}
	
	mysqli_query($con,$sql) or die(mysqli_error());
		$no=$_POST['no'];
		$usia=$_POST['usia'];
		$jadwal=$_POST['jadwal'];
	}
else
	{
	$sql="SELECT * from kelas where id_kelas=".$_POST['no'];

	$result=mysqli_query($con,$sql) or die(mysqli_error());
	if($row = mysqli_fetch_array($result))
		{	
		$no=$_POST['no'];
		$usia=$row[1];
		$jadwal=$row[2];

		}
	}
}


?>
 

<form method="POST">
<fieldset>
<legend>Data Kelas PPA</legend>
<table>
<tr><td>Kelompok Usia <input type="hidden" name="no" value="<?php echo $no;?>" /></td><td>:</td><td>
<select name="usia">
<option value ="5" <?php if($usia=='5') echo "selected='selected'";?>>3-5 Tahun</option>
<option value ="1" <?php if($usia=='1') echo "selected='selected'";?>>6-8 Tahun</option>
  <option value ="2" <?php if($usia=='2') echo "selected='selected'";?>>9-11 Tahun</option>
  <option value ="3" <?php if($usia=='3') echo "selected='selected'";?>>12-14 Tahun</option>
  <option value ="4" <?php if($usia=='4') echo "selected='selected'";?>>15-18 Tahun</option>
   <option value ="6" <?php if($usia=='6') echo "selected='selected'";?>>19-20 Tahun</option>
</select></td></tr>
<tr><td>Jadwal Kegiatan</td><td>:</td><td><select name="jadwal">
  <option value ="1" <?php if($jadwal=='1') echo "selected='selected'";?>>Senin dan Rabu</option>
  <option value ="2" <?php if($jadwal=='2') echo "selected='selected'";?>>Selasa dan Kamis</option>
</select></td></tr>
<tr><td colspan="3" align=center><input type="submit" name="simpan" value="Simpan" />
</td></tr>
</table>
</fieldset>
</form>
</body>
</html>