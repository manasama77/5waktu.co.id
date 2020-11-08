<?php
include('config.php');
// GET POST REQUEST
$id_user   = $_REQUEST['id_user_edit'];
$level     = $_REQUEST['level_edit'];
$status    = $_REQUEST['status_edit'];
$id_dealer = $_REQUEST['id_dealer_edit'];
// GET POST REQUEST

$sql   = "
UPDATE tbl_user SET
level = '".$level."',
status = '".$status."',
id_dealer = '".$id_dealer."'
WHERE id_user = '".$id_user."'
";
$exec = mysqli_query($con, $sql);

if($exec){
	header('location:admin.php?page=listuser');
}else{
	echo "Proses Update User Gagal, silahkan coba kembali!";
}
?>