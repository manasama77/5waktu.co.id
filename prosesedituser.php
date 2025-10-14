<?php
include('config.php');

$id = $_REQUEST['id'];
$username = $_REQUEST['username'];

//echo $id;

$kueri = mysqli_query($con, "UPDATE tbl_user SET username = '$username' WHERE id_user = '$id'");

if($kueri)
{
	echo "<script>window.close();</script>";
}
else
{
	echo("error");
}
?>