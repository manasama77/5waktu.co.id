<?php
session_start();
include('../config.php');

// request
$id_user = $_GET['id_user'];
// end request

$sql = "select * from tbl_user where id_user = '".$id_user."'";
$query = mysqli_query($con, $sql);
$row = mysqli_num_rows($query);

if($row == 0){
	echo json_encode(['total' => $row]);
	exit;
}else{
	$data      = mysqli_fetch_assoc($query);
	$username  = $data['username'];
	$level     = $data['level'];
	$status    = $data['status'];
	$id_dealer = $data['id_dealer'];
	echo json_encode([
		'total'     => $row,
		'id_user'   => $id_user,
		'username'  => $username,
		'level'     => $level,
		'status'    => $status,
		'id_dealer' => $id_dealer
	]);
	exit;
}
?>