<?php
include('config.php');

$username  = $_REQUEST['username'];
// check username
$sql_check   = "select * from tbl_user where username = '".$username."'";
$query_check = mysqli_query($con, $sql_check);
$row_check   = mysqli_num_rows($query_check);

if($row_check > 0){
	echo "Username Telah Digunakan <br>";
	echo '<a href="javascript:history.go(-1)">< GO BACK</a>';
	exit;
}
// end check username

$password  = md5($_REQUEST['username']);
$level     = $_REQUEST['level'];
$status    = $_REQUEST['status'];
$id_dealer = $_REQUEST['id_dealer'];

if($id_dealer == NULL){ $id_dealer = NULL; }

//echo $username;

$kueri = mysqli_query($con, "INSERT INTO tbl_user (id_user, username, password, level, status, id_dealer) VALUES ('','$username', '$password', '$level', '$status', '$id_dealer')");

if($kueri)
{
	header('location:admin.php?page=listuser');
}
else
{
	echo("error");
}

?>