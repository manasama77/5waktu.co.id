<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_satuan_harga_volumetric WHERE id_satuan_harga_volumetric = '$id'");

if($kueri)
{
	header("location:admin.php?page=satuanhargavol");
}
else
{
	echo("error");
}
?>