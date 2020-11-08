<?php
include('config.php');

$tipe_barang = $_REQUEST['tipe_barang'];
$id_barang = $_REQUEST['id_barang'];

$kueri = mysqli_query($con, "INSERT INTO tbl_tipe_barang (id_tipe_barang, tipe_barang, status, id_barang) VALUES ('','$tipe_barang','show', '$id_barang')");

if($kueri)
{
	header('location:admin.php?page=configuration');
}
else
{
	echo("error");
}
?>