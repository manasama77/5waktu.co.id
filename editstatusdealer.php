<?php
include('config.php');

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
if($status == "show")
{
	$kueri = mysqli_query($con, "UPDATE tbl_dealer SET status = 'hide' WHERE id_dealer = '$id'");
}
elseif($status == "hide")
{
	$kueri = mysqli_query($con, "UPDATE tbl_dealer SET status = 'show' WHERE id_dealer = '$id'");
}
else
{
	echo("error kueri");
}

if($kueri)
{
	header("location:admin.php?page=configuration");
}
else
{
	echo("error");
}
?>