<?php
include('config.php');

$id = $_REQUEST['id'];
$satuan_harga_minimum= $_REQUEST['satuan_harga_minimum'];

$kueri = mysqli_query($con, "UPDATE tbl_satuan_harga_minimum SET satuan_harga_minimum = '$satuan_harga_minimum' WHERE id_satuan_harga_minimum= '$id'");

if($kueri)
{
	header('location:admin.php?page=satuanhargamin');
}
else
{
	echo("Gagal mengedit Satuan Harga Minimum");
}
?>