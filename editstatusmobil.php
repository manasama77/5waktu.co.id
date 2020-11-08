<?php
include('config.php');

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
if($status == "show")
{
	$kueri = mysqli_query($con, "UPDATE tbl_mobil SET status = 'hide' WHERE id_mobil = '$id'");
}
elseif($status == "hide")
{
	$kueri = mysqli_query($con, "UPDATE tbl_mobil SET status = 'show' WHERE id_mobil = '$id'");
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