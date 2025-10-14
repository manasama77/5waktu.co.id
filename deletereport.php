<?php
include('config.php');

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
$kueri = mysqli_query($con, "DELETE FROM tbl_report WHERE id_report = '$id'");

if($kueri)
{
	header("location:admin.php?page=pengiriman&&status=$status");
}
else
{
	echo("error");
}
?>