<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_barang = $_REQUEST['nama_barang'];

$kueri = mysqli_query($con, "UPDATE tbl_barang SET nama_barang = '$nama_barang' WHERE id_barang = '$id'");

if($kueri)
{
	echo "<script>window.close();</script>";
}
else
{
	echo("error");
}
?>