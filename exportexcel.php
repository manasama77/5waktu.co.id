<?php
	include "config.php";
	$data = mysqli_query($con,
	"
	SELECT
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

	");
	
	function filterData(&$str)
	{
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}
	
	// file name for download
	$fileName = "All_Report-LimaWaktuLogistic" . date('Ymd') . ".xls";
	
	// headers for download
	header("Content-Disposition: attachment; filename=\"$fileName\"");
	header("Content-Type: application/vnd.ms-excel");
	
	$flag = false;
	foreach($data as $row) {
		if(!$flag) {
			// display column names as first row
			echo implode("\t", array_keys($row)) . "\n";
			$flag = true;
		}
		// filter data
		array_walk($row, 'filterData');
		echo implode("\t", array_values($row)) . "\n";
	}
	
	exit;
?>