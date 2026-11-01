
<?php
if (!isset($place)) {
    $place = '';
}
if (!isset($ttl)) {
    $ttl = '';
}
$page = $_GET['page'] ?? '';
$page_title = 'PPA IO-794';
if ($page == '11') $page_title = 'Mentor PPA';
else if ($page == '12') $page_title = 'Anak PPA';
else if ($page == '13') $page_title = 'Kelas PPA';
else if ($page == '21') $page_title = 'Jadwal Kelas';
else if ($page == '22') $page_title = 'Kelas Anak';
else if ($page == '23') $page_title = 'Absensi Anak';
else if ($page == '31') $page_title = 'MRI';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $page_title; ?></title>
<meta name="keywords" content="Separate keywords or phrases with a comma (example: html code generator, generate html, ...)">
<meta name="description" content="Make it nice and short, but descriptive. The description may appear in search engines' search results pages...">
<style type="text/css">
body {background-color:ffffff;background-image:url(http://);background-repeat:no-repeat;background-position:top left;background-attachment:fixed;}
h1{font-family:Cursive;color:000000;}
p {font-family:Cursive;font-size:14px;font-style:normal;font-weight:normal;color:000000;}
</style>
  <link rel="stylesheet" href="<?php echo $place;?>css/jquery-ui.css" />
    <script src="<?php echo $place;?>js/jquery-1.8.2.js"></script>
    <script src="<?php echo $place;?>js/jquery-ui.js"></script>
    
    <script>
    $(function() {
        $( "#datepicker" ).datepicker({changeMonth: true,changeYear: true});
   	$( "#datepicker" ).datepicker( "option", "dateFormat","yy-mm-dd" );
	<?php if($ttl != '') echo '$( "#datepicker" ).val("'.$ttl.'");';?>
        
    });
    </script>
</head>
<body>
<h1>PPA IO-794</h1>
<ul><li>MASTER
<ul><li><a href="<?php echo $place;?>master/mentor.php?page=11">Mentor</a></li></ul>
<ul><li><a href="<?php echo $place;?>master/anak.php?page=12">Anak PPA</a></li></ul>
<ul><li><a href="<?php echo $place;?>master/kelas.php?page=13">Kelas</a></li></ul>

</li><li>PROSES
<ul><li><a href="<?php echo $place;?>proses/jadwal.php?page=21">Jadwal</a></li></ul>
<ul><li><a href="<?php echo $place;?>proses/kelasanak.php?page=22">Kelas Anak</a></li></ul>
<ul><li><a href="<?php echo $place;?>proses/absenanak.php?page=23">Absensi Anak</a></li></ul>
</li><li>REPORT
<ul><li><a href="<?php echo $place;?>report/mrinew.php?page=31&&generate=n">MRI</a></li></ul>
</li></ul>
