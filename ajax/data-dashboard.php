<?php
header("Content-Type: application/json; charset=UTF-8");
session_start();
/* Database connection start */
include('../config.php');
/* Database connection end */

$id_dealer = $_SESSION['login']['id_dealer'];
$tahun_sekarang = date('Y');

if($id_dealer != ''){
	$qdeal = "AND p.id_dealer = '$id_dealer'";
}else{
	$qdeal = "";
}


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'do_num',
	1 => 'nama_gudang',
	2=> 'do_print_date',
	3=> 'exit_date',
	4=> 'estimation_date',
	5=> 'date_terima_ekspedisi',
	6=> 'nama_dealer',
	7=> 'sum_harga',
	8=> 'status_pengiriman',
	9=> 'delivery_late',
	10=> 'received_name'
);

// getting total number records without any search
$sql = "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE YEAR(p.exit_date) = '$tahun_sekarang' $qdeal ";
$query=mysqli_query($con, $sql) or die("Failed Load Data 1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE YEAR(p.exit_date) = '$tahun_sekarang' $qdeal ";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( p.do_num LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR p.nama_gudang LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR p.exit_date LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR p.estimation_date LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR p.date_terima_ekspedisi LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR p.status_pengiriman LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR p.received_name LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR dealer.nama_dealer LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR p.sum_harga LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR p.do_print_date LIKE '%".$requestData['search']['value']."%' )";
}

//$sql.=$qdeal." ORDER BY p.exit_date DESC";


$query=mysqli_query($con, $sql) or die("Failed Load Data 2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
//$sql.=" ORDER BY p.exit_date DESC";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	

$query=mysqli_query($con, $sql) or die("Failed Load Data 3");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = '<button type="button" class="btn btn-info btn-sm btn-block" onClick="loaddashboardmodal('.$row['id_pengiriman'].')">'.$row['do_num'].'</button>';
	$nestedData[] = $row["nama_gudang"];
	$nestedData[] = $row["do_print_date"];
	$nestedData[] = $row["exit_date"];
	$nestedData[] = $row["estimation_date"];
	$nestedData[] = $row["date_terima_ekspedisi"];
	$nestedData[] = $row["nama_dealer"];
	$nestedData[] = number_format($row["sum_harga"],0);
	$nestedData[] = strtoupper($row["status_pengiriman"]);
	
	if($row["status_pengiriman"] == "delivered"){
		if($row['status_penerimaan'] == "late"){
			$nestedData[] = $row["late"]." Hari";
		}else{
			$nestedData[] = strtoupper($row["status_penerimaan"]);
		}
	}else{
		$nestedData[] = "";
	}
	
	$nestedData[] = strtoupper($row["received_name"]);
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
			
echo json_encode($json_data, JSON_PRETTY_PRINT);  // send data as json format

?>
