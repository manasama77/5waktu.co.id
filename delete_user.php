<?php
include('config.php');
// GET POST REQUEST
$id_user = $_REQUEST['id'];
// GET POST REQUEST

$sql   = "
DELETE FROM tbl_user 
WHERE id_user = '".$id_user."'
";
$exec = mysqli_query($con, $sql);

if($exec){
	header('location:admin.php?page=listuser');
}else{
	echo "Proses Delete User Gagal, silahkan coba kembali!";
}
?>