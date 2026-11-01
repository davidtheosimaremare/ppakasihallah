<?php 
$place='../';
$ttl='';
include $place.'header.php';
include '../db.php';

$no='';
$nama='';
$panggilan='';



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
	
	$sql="SELECT id_mentor from mentor where id_mentor=".$_POST['no'];
	
	$result=mysqli_query($con,$sql) or die(mysqli_error());

	if($row = mysqli_fetch_array($result))
		{

		$sql="UPDATE `mentor` SET `nama_mentor`='".$_POST['nama']."',`nama_panggilan`='".$_POST['panggilan']."' WHERE id_mentor=".$_POST['no'];
		
		echo "Data Mentor Telah Terupdate <br/>";
		}
	else
		{
		$id=1;
		$sql="SELECT id_mentor FROM mentor ORDER BY id_mentor DESC  LIMIT 1";
		
		$result=mysqli_query($con,$sql) or die(mysqli_error());
		if($row = mysqli_fetch_array($result))
			{
			$id=$row[0]+1;
			}
		$sql="INSERT INTO `mentor` (`id_mentor`, `nama_mentor`, `nama_panggilan`) VALUES ('".$id."','".$_POST['nama']."','".$_POST['panggilan']."')";
		
		echo "Data Mentor Telah Tersimpan  <br/>";
		}
	
	mysqli_query($con,$sql) or die(mysqli_error());
		$no=$_POST['no'];
		$nama=$_POST['nama'];
		$panggilan=$_POST['panggilan'];
		
	}
else
	{
	$sql="SELECT * from mentor where id_mentor=".$_POST['no'];

	$result=mysqli_query($con,$sql) or die(mysqli_error());
	if($row = mysqli_fetch_array($result))
		{	
		$no=$_POST['no'];
		$nama=$row[1];
		$panggilan=$row[2];
		
		}
	}
}


?>
 

<form method="POST">
<fieldset>
<legend>Data Mentor PPA</legend>
<table>
<tr><td>Nama Lengkap<input type="hidden" name="no" value="<?php echo $no;?>" /></td><td>:</td><td><input type="text" name="nama" value="<?php echo $nama;?>" maxlength="100" size="50" /></td></tr>
<tr><td>Panggilan</td><td>:</td><td><input type="text" name="panggilan" value="<?php echo $panggilan;?>" maxlength="100" /></td></tr>
<tr><td colspan="3" align=center><input type="submit" name="simpan" value="Simpan" />
</td></tr>
</table>
</fieldset>
</form>
</body>
</html>