<?php
include('config.php');

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
if($status == "show")
{
	$kueri = mysqli_query($con, "UPDATE tbl_tipe_barang SET status = 'hide' WHERE id_tipe_barang = '$id'");
}
elseif($status == "hide")
{
	$kueri = mysqli_query($con, "UPDATE tbl_tipe_barang SET status = 'show' WHERE id_tipe_barang = '$id'");
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