<?php
include('config.php');

$id = $_REQUEST['id'];
$satuan_harga_electone= $_REQUEST['satuan_harga_electone'];

$kueri = mysqli_query($con, "UPDATE tbl_satuan_harga_electone SET satuan_harga_electone = '$satuan_harga_electone' WHERE id_satuan_harga_electone= '$id'");

if($kueri)
{
	header('location:admin.php?page=satuanhargaelectone');
}
else
{
	echo("Gagal mengedit Satuan Harga Electone");
}
?>