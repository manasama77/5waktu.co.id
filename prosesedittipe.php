<?php
include('config.php');

$id = $_REQUEST['id'];
$tipe_barang = $_REQUEST['tipe_barang'];
$id_barang = $_REQUEST['id_barang'];

$kueri = mysqli_query($con, "UPDATE tbl_tipe_barang SET tipe_barang = '$tipe_barang', id_barang = '$id_barang' WHERE id_tipe_barang = '$id'");

if($kueri)
{
	echo "<script>window.close();</script>";
}
else
{
	echo("error");
}
?>