<?php
//this example shows how to use colors, borders and fonts
require('php_xls.php');

$xls=new PHP_XLS();                  //create excel object
$xls->AddSheet('test sheet 1');      //add a work sheet

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

//next we set the header cell sizes
$xls->SetRowHeight(1,30);
$xls->SetColWidth(1,150);
$xls->SetColWidth(2,250);
$xls->SetColWidth(3,100);
$xls->SetColWidth(4,150);

// and we write the header content into the object
$xls->SetActiveStyle('hd_l'); //first cell have header_left style
$xls->Text(1,1,'Column A');
$xls->SetActiveStyle('hd_t'); //next 2 cells have header_top
$xls->Text(1,2,'Column B');
$xls->Text(1,3,'Column C');
$xls->SetActiveStyle('hd_r');  //and the cell in last column is header_right 
$xls->Text(1,4,'Column D');
//now we have the header inserted into worksheet

//for the content we need a style with the top and right borders
$xls->NewStyle('center');
$xls->StyleSetAlignment(-1, 0);
$xls->StyleAddBorder("Top", '#000000', 1);
$xls->StyleAddBorder("Right", '#000000', 1);

$xls->CopyStyle('center','center_l'); //this style is for the first column
$xls->StyleAddBorder("Left", '#000000', 2);

$xls->CopyStyle('center','center_r');  //last column
$xls->StyleAddBorder("Right", '#000000', 2);

//and now we start to fill the data in
$xls->SetActiveStyle('center_l');
$xls->Text(2,1,'004034586523');
$xls->SetActiveStyle('center');
$xls->Text(2,2,'CrissT');
$xls->Number(2,3,'1');
$xls->SetActiveStyle('center_r');
$xls->Text(2,4,'Admin');

//next row
$xls->SetActiveStyle('center_l');
$xls->Text(3,1,'0044567898764');
$xls->SetActiveStyle('center');
$xls->Text(3,2,'Aristo');
$xls->Number(3,3,'2');
$xls->SetActiveStyle('center_r');
$xls->Text(3,4,'Admin jr');

//last row must have the bottom border
$xls->NewStyle('bt');
$xls->StyleSetAlignment(-1, 0);
$xls->StyleAddBorder("Top", '#000000', 1);
$xls->StyleAddBorder("Right", '#000000', 1);
$xls->StyleAddBorder("Bottom", '#000000', 2);

$xls->CopyStyle('bt','bt_l'); //bottom_left
$xls->StyleAddBorder("Left", '#000000', 2);

$xls->CopyStyle('bt','bt_r'); //bottom right
$xls->StyleAddBorder("Right", '#000000', 2);

//and the last row data
$xls->SetActiveStyle('bt_l');
$xls->Text(4,1,'002345678914');
$xls->SetActiveStyle('bt');
$xls->Text(4,2,'Andrei');
$xls->Number(4,3,'5');
$xls->SetActiveStyle('bt_r');
$xls->Text(4,4,'Trepadush');

//finaly we send the document to the browser.
$xls->Output('test_2.xls');
?>
