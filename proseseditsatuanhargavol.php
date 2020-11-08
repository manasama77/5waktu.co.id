<?php
include('config.php');

$id = $_REQUEST['id'];
$satuan_harga_volumetric= $_REQUEST['satuan_harga_volumetric'];

$kueri = mysqli_query($con, "UPDATE tbl_satuan_harga_volumetric SET satuan_harga_volumetric = '$satuan_harga_volumetric' WHERE id_satuan_harga_volumetric= '$id'");

if($kueri)
{
	header('location:admin.php?page=satuanhargavol');
}
else
{
	echo("Gagal mengedit Satuan Harga Volumetric");
}
?>