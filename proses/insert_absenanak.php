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
$date1=array();
$date2=array();
$date=array();
$absen=array();
$active=array();
require '../db.php';



if(!$_POST&&$_GET){
$_POST['no']=$_GET['no'];
$_POST['simpan']='';
$_POST['simpanabsen']='';
$_POST['bulan']='';
$_POST['tahun']='';
$_POST['nokanak']=$_GET['nokanak'];
}
else if($_POST&&$_GET){
$_POST['no']=$_GET['no'];
if(isset($_POST['download']) && $_POST['download']=='Download') {
header("Location: ../excel/PHPExcel-1.8/Examples/download_absen.php?no=".$_POST['no']);
exit;
}
}
if($_POST)
{



$result = mysqli_query($con,"SELECT * FROM jadwal_kelas a LEFT JOIN kelas b ON a.kelas_id=b.id_kelas LEFT JOIN mentor c ON a.mentor_id=c.id_mentor LEFT JOIN kelompok_usia d ON b.kelompok_id=d.id_kelompok LEFT JOIN jadwal_kegiatan e ON b.jadwal_id=e.id_jadwal WHERE id_jkelas=".$_POST['no']) or die(mysqli_error());


if($row = mysqli_fetch_array($result))
	{	
	$no=$_POST['no'];
	$kelas=$row['kelas_id'];
	$bulan=$row['bulan'];
	$tahun=$row['tahun'];
	$mentor=$row['nama_mentor'];
	$usia=$row['nama_kelompok'];
	$jadwal=$row['daftar_jadwal'];
	$lastdate=date('d',mktime(0,0,0,$bulan+1,0,$tahun));
	//-------------*cari tanggal kegiatan*------------------
	$dayone=date('w',mktime(0,0,0,$bulan,1,$tahun));
	$day1=0; $day2=0;
	if($row['id_jadwal']==1){
		$day1=1; $day2=3;
	}
	if($row['id_jadwal']==2){
		$day1=2; $day2=4;
	}
	$hari1=$day1-$dayone;
	if($hari1<0) $hari1=$hari1+7;
	$hari2=$day2-$dayone;
	if($hari2<0) $hari2=$hari2+7;
	if($hari2<$hari1){
	$h=$hari2;
	$hari2=$hari1;
	$hari1=$h;}
	$date1[]=1+$hari1;
	$date2[]=1+$hari2;
	$i=0;
	
	while($date1[$i]+7<=$lastdate){
	$date1[]=$date1[$i]+7;
	$i=$i+1;
	}
	$i=0;
	while($date2[$i]+7<=$lastdate){
	$date2[]=$date2[$i]+7;
	$i=$i+1;
	}
	$i=0;
	while($i<count($date1)){
	$date[]=$date1[$i];

	if($i<count($date2)){
	$date[]=$date2[$i];
	$active[]="checked='true'";
		
	}
	$active[]="checked='true'";
	$i=$i+1;
	}

	}
	//-------------*cari tanggal kegiatan*------------------
	}


if($_POST['simpan']=='Simpan')
	{
	
	$_POST['simpanabsen']='';

	$tanggal=$_POST['aktif'];
	
	$i=0;$t=0;
	$sql="SELECT * FROM kelas_aktif WHERE jkelas_id=".$_POST['no']." ORDER BY id_kelasaktif";
	$result=mysqli_query($con,$sql) or die(mysqli_error());
	$update='n';$aa=0;
	while($row = mysqli_fetch_array($result))
	{
		$aktif='y'; $update='y';
		if($tanggal[$t]!=$date[$i]){
		$aktif='n';
		}
		else{
		$absen[$aa]=$date[$i];
		$aa=$aa+1;
		}
		if($tanggal[$t]==$date[$i]){
		$t=$t+1;
		
		}
		$i=$i+1;
		$sql="UPDATE `kelas_aktif` SET `aktif`='".$aktif."' WHERE id_kelasaktif=".$row['id_kelasaktif'];
		mysqli_query($con,$sql);
	}
	
	if($update=='n')
	{
	$i=0;$t=0;
	$id=1;
	$sql="SELECT id_kelasaktif FROM kelas_aktif ORDER BY id_kelasaktif DESC  LIMIT 1";
	$result=mysqli_query($con,$sql) or die(mysqli_error());
	if($row = mysqli_fetch_array($result))
		{
		$id=$row[0]+1;
		}
	while($i<count($date)){

	$aktif='y';
	if($tanggal[$t]!=$date[$i]){
		$aktif='n';
	}
	$sql="INSERT INTO `kelas_aktif`(`id_kelasaktif`,`jkelas_id`,`tanggal`,`aktif`) VALUES (".$id.",".$_POST['no'].",'".date('Y-m-d',mktime(0,0,0,$bulan,$date[$i],$tahun))."','".$aktif."')";
	mysqli_query($con,$sql);
	$id=$id+1;
	if($tanggal[$t]==$date[$i]){
		$t=$t+1;


		}
	$i=$i+1;
	}
	}
	
	echo "Tanggal Aktif Telah Tersimpan  <br/>";
	}
	$sql="SELECT `aktif` FROM `kelas_aktif` WHERE MONTH( `tanggal` ) =".$bulan." AND YEAR( `tanggal` ) =".$tahun." AND `jkelas_id`=".$_POST['no']." ORDER BY `tanggal`";
	$result=mysqli_query($con,$sql) or die(mysqli_error());
	$i=0;
	while($row = mysqli_fetch_array($result)){
		if($row[0]=='n')
		{
		 $active[$i]="";
		 
		}
		else{
		$absen[]=$date[$i];
		
		}
	$i=$i+1;
	
	}


if($_POST['simpanabsen']=='Simpan')
{
	$absens=$_POST['absensi'];
	$ket=$_POST['ket'];
	$i=0;
	$id=1;
	$sql="SELECT `absen` FROM `absen_anak` WHERE MONTH( `tanggal` ) =".$bulan." AND YEAR( `tanggal` ) =".$tahun." AND `kanak_id`=".$_POST['nokanak']." LIMIT 1";
	$result=mysqli_query($con,$sql) or die(mysqli_error());
	if($row = mysqli_fetch_array($result)){
	$sql="DELETE FROM `absen_anak` WHERE MONTH( `tanggal` ) =".$bulan." AND YEAR( `tanggal` ) =".$tahun." AND `kanak_id`=".$_POST['nokanak'];
	mysqli_query($con,$sql);
	}
	$sql="SELECT id_absen FROM absen_anak ORDER BY id_absen DESC  LIMIT 1";
	$result=mysqli_query($con,$sql) or die(mysqli_error());
	if($row = mysqli_fetch_array($result))
		{
		$id=$row[0]+1;
		}
	while($i<count($absen)){
	$sql="INSERT INTO `absen_anak`(`id_absen`, `kanak_id`, `absen`, `tanggal`, `ket`) VALUES (".$id.",".$_POST['nokanak'].",'".$absens[$i]."','".$tahun."-".$bulan."-".$date[$i]."','".$ket."')";
	$id=$id+1;
	$i=$i+1;
	mysqli_query($con,$sql);
	}
	
	echo "Absensi Telah Tersimpan  <br/>";	
	

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
<input type="hidden" name="nokanak" value="<?php echo $_POST['nokanak']?>"  />
<tr><td colspan="6"><input type="submit" name="download" value="Download" /></td></tr>
<tr><td colspan="6"><table><tr><td>Tanggal Aktif:</td><?php $i=0;while($i<count($date)){ echo "<td>".$date[$i]."<input type='checkbox' name='aktif[]' value='".$date[$i]."' ".$active[$i]." ></td>"; $i=$i+1; }?><td><input type="submit" name="simpan" value="Simpan" /></td></tr></table></tr>

</form>

<tr><td colspan="6">
<table border=1>
<tr><td>NO ANAK</td><td>NAMA ANAK</td><?php $i=0;if(count($absen)>0) {while($i<count($absen)){ echo "<td>".$absen[$i]."</td>"; $i=$i+1;}}else{while($i<count($date)){ echo "<td>".$date[$i]."</td>"; $i=$i+1;}}?><td>EDIT</td></tr>
<?php 
$sql="SELECT id_anak,nama_anak,id_kanak FROM kelas_anak a LEFT JOIN anak_ppa b ON a.anak_id=b.id_anak WHERE jkelas_id=".$_POST['no']." ORDER BY anak_id";
$result=mysqli_query($con,$sql) or die(mysqli_error());
while($row = mysqli_fetch_array($result))
	{
	$sql="SELECT * FROM `absen_anak` WHERE kanak_id=".$row['id_kanak'];
	$result2=mysqli_query($con,$sql) or die(mysqli_error());
	$abs="";
	$i=0;if(count($absen)>0) {
	while($i<count($absen)){ 
		if($row2 = mysqli_fetch_array($result2)) 
		$abs=$abs."<td>".$row2['absen']."</td>"; else $abs=$abs."<td>-</td>"; $i=$i+1;}}else{while($i<count($date)){ if($row2 = mysqli_fetch_array($result2)) $abs=$abs."<td>".$row2['absen']."</td>"; else $abs=$abs."<td>-</td>"; $i=$i+1;}}
	echo "<tr><td>".$row['id_anak']."</td><td>".$row['nama_anak']."</td>".$abs."<td><center><a href='insert_absenanak.php?no=".$no."&&nokanak=".$row['id_kanak']."&&page=22&&generate=n&&edit=y' ><img border='0' width='25' height='25' src='".$place."img/edit.png'/></a></center></td></tr>";	
	}
?>

</table>

</td></tr>

</table>
</td><td>
<?php
if($_GET['edit']=='y'){
	
	echo "<form method='POST'><input type='hidden' name='simpan' value='' ><input type='hidden' name='nokanak' value='".$_REQUEST['nokanak']."' >";
	echo "<table border='1'>";
	echo "<tr><td align='center'>Tanggal</td><td align='center'>Absensi</td><td align='center'>Keterangan</td></tr>";
	
	
	$sql="SELECT `absen`,`ket` FROM `absen_anak` WHERE MONTH( `tanggal` ) =".$bulan." AND YEAR( `tanggal` ) =".$tahun." AND `kanak_id`=".$_POST['nokanak']."  ORDER BY `tanggal`";
	//echo $sql;
	$result=mysqli_query($con,$sql) or die(mysqli_error());
	
	$i=0;
	while($row = mysqli_fetch_array($result)){
		$active[$i]=$row['absen'];
		$ketid[$i]=$row['ket'];
		$i=$i+1;
	}
	$sql="SELECT * FROM `keterangan`";
	$resultket=mysqli_query($con,$sql) or die(mysqli_error());
	$i=0;
	while($row = mysqli_fetch_array($resultket)){
		$rowket[$i]['ket_id']=$row['ket_id'];
		$rowket[$i]['ket_desk']=$row['ket_desk'];
		//$ketid[$i]=$row['ket'];
		$i=$i+1;
	}	

	$i=0;
	while($i<count($absen))
	{ 
		echo "<tr>";
		echo "<td align='center'>".$absen[$i]."</td>";
		?><td><select name='absensi[]'>
			<option value ='1' <?php if($active[$i]=='1') echo 'selected';?>  >Hadir</option>
			<option value ='S' <?php if($active[$i]=='S') echo 'selected';?> >Sakit</option>
			<option value ='I' <?php if($active[$i]=='I') echo 'selected';?> >Izin</option>
			<option value ='A' <?php if($active[$i]=='A') echo 'selected';?> >Alpha </option>
			</select></td>
		<?php
		if($i==0){
		echo "<td rowspan='".count($absen)."'><select name='ket'><option value=''></option>";
		for($a=0;$a<count($rowket);$a++){
		if($ketid[$i]==$rowket[$a]['ket_id'])
		echo "<option value ='".$rowket[$a]['ket_id']."' selected>".$rowket[$a]['ket_desk']."</option>";
		else
		echo "<option value ='".$rowket[$a]['ket_id']."'>".$rowket[$a]['ket_desk']."</option>";
		}
		echo "</select></td>";	
		}
		echo "</tr>";
		$i=$i+1; 
	}?>
	<?php
		
	echo "<tr><td colspan='3' align='center'><input type='submit' name='simpanabsen' value='Simpan' /></td></tr>";
	echo "</table>";
	echo "</form>";
}




?>
</td></tr>
</table>
</fieldset>

</body>
</html>