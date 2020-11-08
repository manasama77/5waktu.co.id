<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_satuan_harga_kota WHERE id_satuan_harga_kota = '$id'");

if($kueri)
{
	header("location:admin.php?page=satuanhargakota");
}
else
{
	echo("error");
}
?>