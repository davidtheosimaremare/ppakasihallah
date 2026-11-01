<?php 
$place='../';
$ttl='';
$bulan='';
$tahun='';
$kepada='';
$komisi='';
$koordinator='';
$data="";
include $place.'header.php';
include $place.'db.php';
$i=1;
if($_GET['generate']=='y'){
$sql="SELECT * FROM sampul ORDER BY id_sampul DESC  LIMIT 1";
	$result=mysql_query($sql,$con) or die(mysql_error());
	if($row = mysql_fetch_array($result))
{
$id=$row['id_sampul']+1;
$sql="INSERT INTO `sampul` VALUES ('".date('n')."','".date('Y')."',".$id.",'".$row['kepada']."','".$row['komisi']."','".$row['koordinator']."')";
	mysql_query($sql,$con);
header('Location: sampul.php?page=31&&generate=n');
}
}
if($_POST){
$tahun=$_POST['tahun'];
$bulan=$_POST['bulan'];
$kepada=$_POST['kepada'];
$komisi=$_POST['komisi'];
$koordinator=$_POST['koordinator'];

	$id=1;
	$sql="SELECT id_sampul FROM sampul ORDER BY id_sampul DESC  LIMIT 1";
	$result=mysql_query($sql,$con) or die(mysql_error());
	if($row = mysql_fetch_array($result))
		{
		$id=$row[0]+1;
		}
	$sql="INSERT INTO `sampul` VALUES ('".$bulan."','".$tahun."',".$id.",'".$kepada."','".$komisi."','".$koordinator."')";
	mysql_query($sql,$con);

}
echo "<table border=1>";
?>
<form method="POST">
<tr><td colspan=2><center><a href='sampul.php?page=31&&generate=y' ><img border='0' width='100' height='100' src='<?php echo $place?>img/generate.png'/></a></center></td>
</tr>
<tr><td colspan=2><center><b>GENERATE BULAN INI</b></center></td></tr>

<tr><td colspan='7'>
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
</select> 
</center>
</td></tr>
<tr>
<td>Kepada</td><td>
<input type="text" name="kepada" value="" size="40" />
</td>
</tr>
<tr>
<td>Komisi</td><td>
<input type="text" name="komisi" value="" size="40" />
</td>
</tr>
<tr>
<td>Koordinator</td><td>
<input type="text" name="koordinator" value="" size="40" />
</td>
</tr>
<tr>
<td colspan=2 align='center'>
<input type="submit" name="simpan" value="Simpan" />
</td>
</tr>

</form>


<?php
include $place.'footer.php';
?>
