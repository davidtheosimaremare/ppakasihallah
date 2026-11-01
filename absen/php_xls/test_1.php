<?php
//this is a very simple example on how to use php_xls
//it reads data from a text file with this structure:
//Rank;Country;Internet users;% of pop.;Date
//and fill it into an  excel workbook

require('php_xls.php');
require('../db.php');
$xls=new PHP_XLS();   //excel object
$xls->AddSheet('Countries by internet users'); //our sheet

//we need 5 columns with different sizes
$xls->SetColWidth(1,40);
 $xls->Text(1,1,"ABSENSI");
//$xls->SetColWidth(2,150);
//$xls->SetColWidth(3,100);
//$xls->SetColWidth(4,80);
//$xls->SetColWidth(5,50);

$xls->Text(2,1,"MENTOR");

//Read file lines
/*$lines=file('internet_users.txt');
$row=1;
foreach($lines as $line)  //for each line
{
	$data=explode(';',$line); //get cells data
	$col=1;
	foreach ($data as $cell)
		$xls->Text($row,$col++,$cell);  //and put it into the excel object
	$row++;	
}
*/
/*$sql="SELECT id_anak,nama_anak,id_kanak FROM kelas_anak a LEFT JOIN anak_ppa b ON a.anak_id=b.id_anak WHERE jkelas_id=".$_POST['no'];
$result=mysql_query($sql,$con) or die(mysql_error());
while($row = mysql_fetch_array($result))
	{
	$sql="SELECT * FROM `absen_anak` WHERE kanak_id=".$row['id_kanak'];
	$result2=mysql_query($sql,$con) or die(mysql_error());
	$absen="";
	$i=0;while($i<count($date)){ if($row2 = mysql_fetch_array($result2)) $absen=$absen."<td>".$row2['absen']."</td>"; else $absen=$absen."<td>-</td>"; $i=$i+1;}
	echo "<tr><td>".$row['id_anak']."</td><td>".$row['nama_anak']."</td>".$absen."<td><center><a href='insert_absenanak.php?no=".$no."&&nokanak=".$row['id_kanak']."&&page=22&&generate=n&&edit=y' ><img border='0' width='25' height='25' src='".$place."img/edit.png'/></a></center></td></tr>";	
	}

*/
$xls->Output('test_1.xls');
?>
