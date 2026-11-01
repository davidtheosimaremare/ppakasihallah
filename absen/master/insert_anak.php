
<?php 

$no='';
$nama='';
$panggilan='';
$jk='';
$ttl='';
$agama='';
$na='';
$pa='';
$ha='';
$ni='';
$pi='';
$hi='';
$tanggungan='';
$min18='';
$jarak='';
$alamat='';
$ket='';
$hasil='';
if(!$_POST&&$_GET){
$_POST['no']=$_GET['no'];
$_POST['simpan']='';
}
else if($_POST&&$_GET){
//$_POST['no']=$_GET['no'];
}
if($_POST)
{
require '../db.php';
if($_POST['simpan']=='Simpan')
	{
	if($_POST['tanggungan']=='')
		$_POST['tanggungan']=0;
	if($_POST['min18']=='')
		$_POST['min18']=0;
	if($_POST['jarak']=='')
		$_POST['jarak']=0;
	$sql="SELECT id_anak from anak_ppa where id_anak='IO-794-0".$_POST['no']."'";
	$result=mysql_query($sql,$con) or die(mysql_error());
	if($row = mysql_fetch_array($result))
		{
		$sql="UPDATE `anak_ppa` SET `id_anak`='IO-794-0".$_POST['no']."',`nama_anak`='".$_POST['nama']."',`nama_panggilan`='".$_POST['panggilan']."',`jenis_kelamin`='".$_POST['jk']."',`tgl_lahir`='".$_POST['ttl']."',
		`agama`='".$_POST['agama']."',`nama_ayah`='".$_POST['namaayah']."',`pekerjaan_ayah`='".$_POST['pekerjaanayah']."',`penghasilan_ayah`='".$_POST['penghasilanayah']."',`nama_ibu`='".$_POST['namaibu']."',`pekerjaan_ibu`='".$_POST['pekerjaanibu']."',`penghasilan_ibu`='".$_POST['penghasilanibu']."',`jumlah_tanggungan`=".$_POST['tanggungan'].",`jumlah_min18`=".$_POST['min18'].",`jarak_rumah`=".$_POST['jarak'].",`alamat_rumah`='".$_POST['alamat']."',`keterangan`='".$_POST['ket']."' WHERE
		`id_anak`='IO-794-0".$_POST['no']."'";
		$hasil= "Data Anak Telah Terupdate <br/>";
		}
	else
		{
		$sql="INSERT INTO `anak_ppa`(`id_anak`, `nama_anak`, `nama_panggilan`, `jenis_kelamin`, `tgl_lahir`, `agama`, `nama_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `jumlah_tanggungan`, `jumlah_min18`, `jarak_rumah`, `alamat_rumah`, `keterangan`) 
		VALUES ('IO-794-0".$_POST['no']."','".$_POST['nama']."','".$_POST['panggilan']."','".$_POST['jk']."','".$_POST['ttl']."','".$_POST['agama']."','".$_POST['namaayah']."','".$_POST['pekerjaanayah']."','".$_POST['penghasilanayah']."','".$_POST['namaibu']."','".$_POST['pekerjaanibu']."','".$_POST['penghasilanibu']."',".$_POST['tanggungan'].",".$_POST['min18'].",".$_POST['jarak'].",'".$_POST['alamat']."','".$_POST['ket']."')";

		$hasil= "Data Anak Telah Tersimpan  <br/>";
		}
	
	mysql_query($sql,$con) or die(mysql_error());
		$no=$_POST['no'];
		$nama=$_POST['nama'];
		$panggilan=$_POST['panggilan'];
		$jk=$_POST['jk'];
		$ttl=$_POST['ttl'];
		$agama=$_POST['agama'];
		$na=$_POST['namaayah'];
		$pa=$_POST['pekerjaanayah'];
		$ha=$_POST['penghasilanayah'];
		$ni=$_POST['namaibu'];
		$pi=$_POST['pekerjaanibu'];
		$hi=$_POST['penghasilanibu'];
		$tanggungan=$_POST['tanggungan'];
		$min18=$_POST['min18'];
		$jarak=$_POST['jarak'];
		$alamat=$_POST['alamat'];
		$ket=$_POST['ket'];
	}
else
	{
	$sql="SELECT * from anak_ppa where id_anak='IO-794-0".$_POST['no']."'";
	$result=mysql_query($sql,$con) or die(mysql_error());
	if($row = mysql_fetch_array($result))
		{	
		$no=$_POST['no'];
		$nama=$row[1];
		$panggilan=$row[2];
		$jk=$row[3];
		$ttl=$row[4];
		$agama=$row[5];
		$na=$row[6];
		$pa=$row[7];
		$ha=$row[8];
		$ni=$row[9];
		$pi=$row[10];
		$hi=$row[11];
		$tanggungan=$row[12];
		$min18=$row[13];
		$jarak=$row[14];
		$alamat=$row[15];
		$ket=$row[16];
		}
	}





}
$place="../";
require '../header.php';
echo $hasil;
?>
 

<form method="POST">
<fieldset>
<legend>Data Anak PPA</legend>
<table>
<tr><td>No Anak</td><td>:</td><td>IO-794-0<input type="text" name="no" value="<?php echo $no;?>" maxlength="3" size="3" /></td></tr>

<tr><td>Nama Lengkap</td><td>:</td><td><input type="text" name="nama" value="<?php echo $nama;?>" maxlength="100" size="50" /></td></tr>
<tr><td>Panggilan</td><td>:</td><td><input type="text" name="panggilan" value="<?php echo $panggilan;?>" maxlength="100" /></td></tr>
<tr><td>Jenis Kelamin</td><td>:</td><td><input type="radio" name="jk" value="L" <?php if($jk=='L' || $jk=='') echo "checked='true'";?> /> Laki-Laki
<input type="radio" name="jk" value="P" <?php if($jk=='P') echo "checked='true'";?> />Perempuan</td></tr>
<tr><td>Tanggal Lahir</td><td>:</td><td><input type="text" name="ttl" value="<?php echo $ttl;?>" id="datepicker" /></td></tr>
<tr><td>Agama</td><td>:</td><td><select name="agama">
  <option value ="Kristen" <?php if($agama=='Kristen') echo "selected='selected'";?>  >Kristen</option>
  <option value ="Katolik" <?php if($agama=='Katolik') echo "selected='selected'";?>>Katolik</option>
  <option value ="Islam" <?php if($agama=='Islam') echo "selected='selected'";?>>Islam</option>
  <option value ="Hindu" <?php if($agama=='Hindu') echo "selected='selected'";?>>Hindu</option>
  <option value ="Budha" <?php if($agama=='Budha') echo "selected='selected'";?>>Budha</option>
</select></td></tr>
<tr><td valign="top">Ayah</td><td valign="top">:</td><td><table><tr><td>Nama</td><td><input type="text" name="namaayah" value="<?php echo $na;?>" maxlength="100" size="50" /></td></tr><tr><td>Pekerjaan</td><td><input type="text" name="pekerjaanayah" value="<?php echo $pa;?>" maxlength="100" size="30" /></td></tr><tr><td>Penghasilan</td><td><input type="text" name="penghasilanayah" value="<?php echo $ha;?>" maxlength="100" size="20" /></td></tr></table></td></tr>
<tr><td valign="top">Ibu</td><td valign="top">:</td><td><table><tr><td>Nama</td><td><input type="text" name="namaibu" value="<?php echo $ni;?>" maxlength="100" size="50" /></td></tr><tr><td>Pekerjaan</td><td><input type="text" name="pekerjaanibu" value="<?php echo $pi;?>" maxlength="100" size="30" /></td></tr><tr><td>Penghasilan</td><td><input type="text" name="penghasilanibu" value="<?php echo $hi;?>" maxlength="100" size="20" /></td></tr></table></td></tr>
<tr><td>Jumlah Tanggungan Keluarga</td><td>:</td><td><input type="text" name="tanggungan" value="<?php echo $tanggungan;?>" maxlength="100" size="2" /></td></tr>
<tr><td>Jumlah L/P Di Bawah 18 THN</td><td>:</td><td><input type="text" name="min18" value="<?php echo $min18;?>" maxlength="100" size="2" /></td></tr>
<tr><td>Jarak Rumah Anak Ke PPA</td><td>:</td><td><input type="text" name="jarak" value="<?php echo $jarak;?>" maxlength="100" size="2" /></td></tr>
<tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat" value="<?php echo $alamat;?>" maxlength="100" size="50" /></td></tr>
<tr><td>Keterangan</td><td>:</td><td><input type="textarea" name="ket" value="<?php echo $ket;?>" rows="3" cols="30" /></td></tr>
<tr><td colspan="3" align=center><input type="submit" name="simpan" value="Simpan" />
</td></tr>
</table>
</fieldset>
</form>
</body>
</html>