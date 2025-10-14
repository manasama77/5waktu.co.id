<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_dealer WHERE id_dealer = '$id'");

if($kueri)
{
	header("location:admin.php?page=dealer");
}
else
{
	echo("error");
}
?>