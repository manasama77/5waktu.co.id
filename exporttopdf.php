<?php
require('fpdf.php');
//most of the entries here are self explanatory, PHP advance scripting knowledge preferred. If any doubts please let us know through your comments in http://mistonline.in/wp/export-mysql-database-table-to-pdf-using-php-2/
$d=date('d_m_Y');
//Modified by mistonline team

class PDF extends FPDF
{

function Header()
{
    //Logo
	$name="Report Data Pengiriman Lima Waktu Logistic - ";
    $this->SetFont('Arial','B',16);
    //Move to the right
    //Title
    $this->Cell(0,0,"$name".date('d-m-Y'),0,1,'C');
	$this->SetFont('Arial','B',8);
    //Line break
    $this->Ln(5);
}

//Simple table
function BasicTable($header,$data)
{ 

$this->SetFillColor(255,0,0);
$this->SetDrawColor(128,0,0);
$w=array(10,18,15,20,17,20,20,20,16,35,35,35,35,18,13,18,18,18,18);

	//Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],10,$header[$i],1,0,'C',true);
	$this->Ln();
	//Data
	foreach ($data as $eachResult) 
	{ //width
		$this->Cell(10,6,$eachResult["Num"],1,0,'C',true);
		$this->Cell(18,6,$eachResult["Vehicle Num"],1,0,'C');
		$this->Cell(15,6,$eachResult["Driver"],1,0,'C');
		$this->Cell(20,6,$eachResult["Delivery Asst."],1,0,'C');
		$this->Cell(17,6,$eachResult["DO Num"],1,0,'C');
		$this->Cell(20,6,$eachResult["DO Print Date"],1,0,'C');
		$this->Cell(20,6,$eachResult["Exit Date"],1,0,'C');
		$this->Cell(20,6,$eachResult["Received Date"],1,0,'C');
		$this->Cell(16,6,$eachResult["Received Num"],1,0,'C');
		$this->Cell(35,6,$eachResult["Dealer"],1,0,'C');
		$this->Cell(35,6,$eachResult["Expedition"],1,0,'C');
		$this->Cell(35,6,$eachResult["Region"],1,0,'C');
		$this->Cell(35,6,$eachResult["Product Name"],1,0,'C');
		$this->Cell(18,6,$eachResult["Class Type"],1,0,'C');
		$this->Cell(13,6,$eachResult["Qty"],1,0,'C');
		$this->Cell(18,6,$eachResult["Total Weight"],1,0,'C');
		$this->Cell(18,6,$eachResult["Total Volumetric"],1,0,'C');
		$this->Cell(18,6,$eachResult["Price / Unit"],1,0,'C');
		$this->Cell(18,6,$eachResult["Total Price"],1,0,'C');
		$this->Ln();
		 	 	 	 	
	}
}

//Better table
}

$pdf=new PDF('L','mm','A3');
$header=array('Num','No Polisi','Driver','Delivery Asst.','DO Num','DO Print Date','Exit Date','Received Date','Recv. Num','Dealer','Expedition','Region','Product Name','Class Type','Qty','Total Weight','Total Volume','Price','Total Price');
//Data loading
//*** Load MySQL Data ***//
$objConnect = mysql_connect("localhost","manasama_lwl","admin!@#") or die("Error:Please check your database username & password");
$objDB = mysql_select_db("manasama_lwldb");
$strSQL = "SELECT
tbl_report.id_report 'Num',
tbl_vehicle.no_polisi 'Vehicle Num',
tbl_driver.nama 'Driver',
tbl_assistant.nama 'Delivery Asst.',
tbl_report.do_num 'DO Num',
tbl_report.do_print_date 'DO Print Date',
tbl_report.exit_date 'Exit Date',
tbl_report.received_date 'Received Date',
tbl_report.received_num 'Received Num',
tbl_dealer.nama_dealer 'Dealer',
tbl_expedition.nama_expedition 'Expedition',
tbl_region.nama_region 'Region',
tbl_product_catalog.product_name 'Product Name',
tbl_class_pricelist.class_type 'Class Type',
tbl_report.quantity 'Qty',
tbl_report.total_weight 'Total Weight',
tbl_report.total_volumetric'Total Volumetric',
tbl_report.price'Price / Unit',
tbl_report.total_price'Total Price',
tbl_report.description'Notes'
FROM
tbl_report
Inner Join tbl_vehicle ON tbl_report.id_vehicle = tbl_vehicle.id_vehicle
Inner Join tbl_driver ON tbl_report.id_driver = tbl_driver.id_driver
Inner Join tbl_assistant ON tbl_report.id_assistant = tbl_assistant.id_assistant
Inner Join tbl_dealer ON tbl_report.id_dealer = tbl_dealer.id_dealer
Inner Join tbl_expedition ON tbl_dealer.id_expedition = tbl_expedition.id_expedition
Inner Join tbl_region ON tbl_dealer.id_region = tbl_region.id_region
Inner Join tbl_product_catalog ON tbl_report.id_product_catalog = tbl_product_catalog.id_product_catalog
Inner Join tbl_class_pricelist ON tbl_product_catalog.id_class_name = tbl_class_pricelist.id_class_name AND tbl_class_pricelist.id_region = tbl_region.id_region
Inner Join tbl_class_name ON tbl_class_pricelist.id_class_name = tbl_class_name.id_class_name
";
$objQuery = mysql_query($strSQL);
$resultData = array();
for ($i=0;$i<mysql_num_rows($objQuery);$i++) {
	$result = mysql_fetch_array($objQuery);
	array_push($resultData,$result);
}
//************************//


/*function forme()

{
$d=date('d_m_Y');
echo "Data generated succesfully. Download it here <a href=".$d.".pdf>DOWNLOAD</a>";
}*/

$d=date('d_m_Y');
$pdf->SetFont('Arial','',8);

//*** Table 1 ***//
$pdf->AddPage();
//$pdf->Image('mylogo.jpg',80,8,33);
$pdf->Ln(5);
$pdf->BasicTable($header,$resultData);
//forme();
$pdf->Output();?>
