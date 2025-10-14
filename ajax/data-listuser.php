<?php
header("Content-Type: application/json; charset=UTF-8");
session_start();
/* Database connection start */
include('../config.php');
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$columns = array(
	// datatable column index  => database column name
	0  => 'tbl_user.id_user',
	1  => 'tbl_user.username',
	2  => 'tbl_user.level',
	3  => 'tbl_user.status',
	4  => 'tbl_dealer.nama_dealer',
	5  => 'tbl_kota.nama_kota',
	6  => 'tbl_ekspedisi.nama_ekspedisi'
);

// getting total number records without any search
$sql_count     = "SELECT * FROM tbl_user ";
$query         = mysqli_query($con, $sql_count) or die("Failed Load Data 1");
$totalData     = mysqli_num_rows($query);
$totalFiltered = $totalData;


$sql = "SELECT 
	tbl_user.id_user,
	tbl_user.username,
	tbl_user.level,
	tbl_user.status,
	tbl_dealer.nama_dealer,
	tbl_kota.nama_kota,
	tbl_ekspedisi.nama_ekspedisi 
	FROM tbl_user 
	LEFT JOIN tbl_dealer ON tbl_dealer.id_dealer = tbl_user.id_dealer
	LEFT JOIN tbl_kota ON tbl_kota.id_kota = tbl_dealer.id_kota
	LEFT JOIN tbl_ekspedisi ON tbl_ekspedisi.id_ekspedisi = tbl_dealer.id_ekspedisi ";

// if there is a search parameter, $requestData['search']['value'] contains search parameter
if (!empty($requestData['search']['value'])) {
	$sql .= " WHERE ( tbl_user.username LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR tbl_user.id_user LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR tbl_user.level LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR tbl_user.status LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR tbl_dealer.nama_dealer LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR tbl_kota.nama_kota LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR tbl_ekspedisi.nama_ekspedisi LIKE '%" . $requestData['search']['value'] . "%' )";
}


$query         = mysqli_query($con, $sql) or die("Failed Load Data 2");
$totalFiltered = mysqli_num_rows($query);
$sql           .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "  ";

$query = mysqli_query($con, $sql) or die("Failed Load Data 3");

$data = array();

while ($row = mysqli_fetch_array($query)) {
	$nestedData = array();
	$nestedData[] = $row['id_user'];
	$nestedData[] = $row["username"];
	$nestedData[] = $row["level"];
	$nestedData[] = $row["status"];
	$nestedData[] = $row["nama_dealer"];
	$nestedData[] = $row["nama_kota"];
	$nestedData[] = $row["nama_ekspedisi"];
	$config_btn = '';
	if ($row['id_user'] != '1' && $row['username'] != "adam") {
		$config_btn = '
		<div class="btn-group">
			<button type="button" class="btn btn-info btn-sm" onclick="editUser(\'' . $row['id_user'] . '\', \'' . $row['username'] . '\');" title="Edit"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onclick="deleteUser(\'' . $row['id_user'] . '\', \'' . $row['username'] . '\');" title="Delete"><i class="fa fa-trash"></i></button>
			<button type="button" class="btn btn-default btn-sm" onclick="resetUser(\'' . $row['id_user'] . '\', \'' . $row['username'] . '\');" title="Reset Password"><i class="fa fa-key"></i></button>
		</div>
		';
	}
	$nestedData[] = $config_btn;
	$data[]       = $nestedData;
}

$json_data = array(
	"draw"            => intval($requestData['draw']),
	"recordsTotal"    => intval($totalData),
	"recordsFiltered" => intval($totalFiltered),
	"data"            => $data
);

echo json_encode($json_data, JSON_PRETTY_PRINT);  // send data as json format