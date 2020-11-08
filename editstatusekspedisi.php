<?php
include('config.php');

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
if($status == "show")
{
	$kueri = mysqli_query($con, "UPDATE tbl_ekspedisi SET status = 'hide' WHERE id_ekspedisi = '$id'");
}
elseif($status == "hide")
{
	$kueri = mysqli_query($con, "UPDATE tbl_ekspedisi SET status = 'show' WHERE id_ekspedisi = '$id'");
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