<?php
//this example combines the styles from the second example with the dynamic data aquisition

require('php_xls.php');

$xls=new PHP_XLS();                  //create excel object
$xls->AddSheet('test sheet 1');      //add a work sheet

//moved on top the styles definitions
//next section will create the styles for the cells (borders, background,...)
$xls->NewStyle('hd_t');          //header with top border     
$xls->StyleSetBackground('#A6CAF0');    //color
$xls->StyleSetFont(0, 12, 0, 1, 0, 0);  //font parameters
$xls->StyleSetAlignment(-1, 0);         //cell alignment
$xls->StyleAddBorder("Top", '#000000', 2);  //top border
$xls->StyleAddBorder("Right", '#000000', 1);  //right thin border separating header cells

$xls->CopyStyle('hd_t','hd_l');  // now we just copy the header with top border to header_left 
$xls->StyleAddBorder("Left", '#000000', 2);  //and set the left border 

$xls->CopyStyle('hd_t','hd_r');  //copy the header wit top border to header_right
$xls->StyleAddBorder("Right", '#000000', 2);  //and thicken the right border so it will end the table

//for the content we need a style with the top and right borders
$xls->NewStyle('center');
$xls->StyleSetAlignment(-1, 0);
$xls->StyleAddBorder("Top", '#000000', 1);
$xls->StyleAddBorder("Right", '#000000', 1);

$xls->CopyStyle('center','center_l'); //this style is for the first column
$xls->StyleAddBorder("Left", '#000000', 2);

$xls->CopyStyle('center','center_r');  //last column
$xls->StyleAddBorder("Right", '#000000', 2);

//bottom border
$xls->NewStyle('bt');
$xls->StyleSetAlignment(-1, 0);
$xls->StyleAddBorder("Top", '#000000', 1);
$xls->StyleAddBorder("Right", '#000000', 1);
$xls->StyleAddBorder("Bottom", '#000000', 2);

$xls->CopyStyle('bt','bt_l'); //bottom_left
$xls->StyleAddBorder("Left", '#000000', 2);

$xls->CopyStyle('bt','bt_r'); //bottom right
$xls->StyleAddBorder("Right", '#000000', 2);


//now we try to fetch data from file


$lines=file('internet_users.txt');
$row=1;
foreach($lines as $line_no => $line)  //for each line
{
	switch ($line_no)
	{
		case 0:
			$style='hd';
			break;
		case count($lines)-1:
			$style='bt';
			break;
		default:	
			$style='center';
	}
	
	$data=explode(';',$line); //get cells data
	$col=1;
	foreach ($data as $coll_no => $cell)
	{
		switch ($coll_no)
		{
			case 0:
			$border='_l';
			break;
		case count($data)-1:
			$border='_r';
			break;
		default:	
			$border='';
		}
		$xls->SetActiveStyle($style . $border);
		$xls->Text($row,$col++,$cell);  //and put it into the excel object
	}
	$row++;	
}

//finaly we send the document to the browser.
$xls->Output('test_3.xls');
?>
